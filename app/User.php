<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'register_ip', 'last_ip',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Get the join tokens for the user.
	 */
	public function joinTokens()
	{
		return $this->hasMany('App\GameJoin');
	}

	/**
	 * Get the body colors for the user.
	 */
	public function getColors()
	{
		return $this->hasOne('App\BodyColors');
	}

	/**
	 * Get the created assets for the user.
	 */
	public function getAssets()
	{
		return $this->hasMany('App\Asset');
	}

	/**
	 * Get the owned assets for the user.
	 */
	public function ownedAssets()
	{
		return $this->hasMany(\App\OwnedAsset::class);
	}

	public function isAdmin()
	{
		if($this->rank == "Admin")
		{
			return true;
		}

		return false;
	}

	public function isMod()
	{
		if($this->rank == "Admin" || $this->rank == "Moderator")
		{
			return true;
		}

		return false;
	}
}
