<?php 

namespace Ahmedash95\UsersVerification;

use Illuminate\Support\Str;

trait UsersVerification {

	public function token(){
		return $this->hasOne(UsersToken::class);
	}

	public function verified(){
		return $this->token ? $this->token->verified : false;
	}

	public function verifyToken($token){
		if(!$this->token){
			throw new \Exception("User has no tokens");
		}
		return $this->getToken() == $token;
	}

	public function verifiy(){
		if(!$this->token){
			throw new \Exception("User has no tokens");
		}
		$this->token->update(['verified' => 1]);
	}

	public function generateToken(){
		$model = new UsersToken;
		$model->user_id = $this->id;
		$model->token = Str::random('60');
		$model->save();
		return $model;
	}

	public function getToken(){
		if(!$this->token){
			return $this->generateToken()->token;
		}

		return $this->token->token;
	}

	public static function findByToken($token){
		return static::whereHas('token',function($query) use ($token) {
			return $query->where('token',$token);
		})->first();
	}

	public function flushToken(){
		if(!$this->token) return ;
		$this->token->delete();
	}

}