<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 5/30/18
 * Time: 12:39 AM
 */

namespace Application\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Domain
 * @property int $id
 * @property string $domain_name
 * @property string $token
 * @property integer $stamp_mask
 *
 * @package Application\Models
 */
class User extends Model
{
    /**
     * Allow fill only this properties
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'age'
    ];
}