<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Models;

use CodeIgniter\Model;

class LevelModel extends Model
{
    protected $table      = 'level';
    protected $primaryKey = 'id_level';
    protected $allowedFields = ['level'];
}
