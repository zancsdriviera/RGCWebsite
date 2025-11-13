<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentRatesContent extends Model
{
    use HasFactory;

    protected $table = 'tournament_rates_contents';

    protected $fillable = [
        'season',
        'green_fee',
        'scoring_fee',
        'caddie_fee',
        'golf_cart_fee',
        'hole_in_one_fund',
        'sports_dev_fund',
        'environmental_fund',
        'food_beverage',
    ];
}
