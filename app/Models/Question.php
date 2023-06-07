<?php

namespace App\Models;

use App\Enums\QuestionDifficultyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'difficulty',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'difficulty' => QuestionDifficultyEnum::class,
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function correctAnswers()
    {
        return $this->hasMany(Answer::class)->where('is_correct', true);
    }
}
