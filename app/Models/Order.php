<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /**
     * @var array<int, string>
     */
    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PAID,
        self::STATUS_SHIPPED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];

    /**
     * @var array<string, array<int, string>>
     */
    private const STATUS_TRANSITIONS = [
        self::STATUS_PENDING => [self::STATUS_PAID, self::STATUS_CANCELLED],
        self::STATUS_PAID => [self::STATUS_SHIPPED, self::STATUS_CANCELLED],
        self::STATUS_SHIPPED => [self::STATUS_COMPLETED],
        self::STATUS_COMPLETED => [],
        self::STATUS_CANCELLED => [],
    ];

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'subtotal_price' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'total_price' => 'decimal:2',
            'payment_proof_uploaded_at' => 'datetime',
            'payment_verified_at' => 'datetime',
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function statuses(): array
    {
        return self::STATUSES;
    }

    public function canTransitionTo(string $targetStatus): bool
    {
        if ($this->status === $targetStatus) {
            return true;
        }

        return in_array($targetStatus, self::STATUS_TRANSITIONS[$this->status] ?? [], true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentVerifier()
    {
        return $this->belongsTo(User::class, 'payment_verified_by');
    }

    public function isTransferPayment(): bool
    {
        $paymentText = strtolower(trim((string) $this->payment_method_code . ' ' . (string) $this->payment_method_name));

        return Str::contains($paymentText, ['transfer', 'tf']);
    }

    public function isCodPayment(): bool
    {
        $paymentText = strtolower(trim((string) $this->payment_method_code . ' ' . (string) $this->payment_method_name));

        return Str::contains($paymentText, ['cod', 'cash', 'tunai']);
    }

    public function canUploadTransferProof(): bool
    {
        return $this->isTransferPayment() && $this->status === self::STATUS_PENDING;
    }
}
