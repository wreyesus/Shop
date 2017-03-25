<?php

/*
 * This file is part of the Antvel Shop package.
 *
 * (c) Gustavo Ocanto <gustavoocanto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Antvel\User;

use Antvel\AddressBook\Models\Address;
use Antvel\User\Models\ { Person, Business, Presenters, EmailChangePetition };

trait hasAntvel
{
    use Presenters;

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        (new static)->initializeAntvelAttributes();
    }

    /**
     * Initialize model attributes
     *
     * @return void
     */
    protected function initializeAntvelAttributes()
    {
        $this->fillable([
            'facebook', 'mobile_phone', 'work_phone', 'description',
            'pic_url', 'language', 'website', 'twitter',
            'nickname', 'email', 'password', 'role',
            'disabled_at', 'confirmation_token'
        ]);

        $this->setHidden(['password', 'remember_token']);

        $this->addDateAttributesToArray(['deleted_at']);
    }

    /**
     * Returns the user profile.
     *
     * @return mixed
     */
	public function profile()
    {
        if (in_array($this->role, ['business', 'nonprofit'])) {
            return $this->hasOne(Business::class);
        }

        return $this->hasOne(Person::class);
    }

    /**
     * Returns the user addressBook.
     *
     * @return Address
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * The user email change petitions.
     *
     * @return EmailChangePetition
     */
    public function emailChangePetitions()
    {
        return $this->hasMany(EmailChangePetition::class);
    }



    // ======================================= //
    //        temporary while refactoring      //
    // ======================================= //

     public function hasRole($role)
    {
        if (is_array($role)) {
            return in_array($this->attributes['role'], $role);
        }

        return $this->attributes['role'] == $role;
    }

    public function isAdmin()
    {
        return $this->attributes['role'] == 'admin';
    }

    public function isPerson()
    {
        return $this->attributes['role'] == 'person';
    }

    public function isCompany()
    {
        return $this->attributes['role'] == 'business';
    }

   public function isTrusted()
   {
       return $this->attributes['type'] == 'trusted';
   }
}
