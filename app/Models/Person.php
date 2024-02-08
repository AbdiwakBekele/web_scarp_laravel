<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PreviousAddress;
use App\Models\Aka;
use App\Models\Phone;
use App\Models\Relative;
use App\Models\Associate;
use App\Models\Education;
use App\Models\Work;
use App\Models\Business;

class Person extends Model {
    use HasFactory;
    protected $fillable = [
        'fullname',
        'age',
        'current_address',
        'current_employment',
        'report'
    ];

    public function previousAddresses() {
        return $this->hasMany(PreviousAddress::class);
    }

    public function phones() {
        return $this->hasMany(Phone::class);
    }

    public function akas() {
        return $this->hasMany(Aka::class);
    }

    public function relatives() {
        return $this->hasMany(Relative::class);
    }

    public function associates() {
        return $this->hasMany(Associate::class);
    }

    public function educations() {
        return $this->hasMany(Education::class);
    }

    public function works() {
        return $this->hasMany(Work::class);
    }

    public function businesses() {
        return $this->hasMany(Business::class);
    }
}
