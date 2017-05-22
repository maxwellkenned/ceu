<?php

namespace ceu\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Arquivo extends Model
{
    use SyncsWithFirebase;
}
