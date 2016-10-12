<?php

class Links {
	private $redis;
	
	public function __construct() {
		$this->redis = new redis_cli();
	}
	
	public function getUniqID($length = 8) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		
		return $randomString;
	}
	
	public function add($link) {
		$id = $this->getUniqID();
		
		$res = $this->redis->cmd('HSET', 'links', $id, $link)->set();
		
		if ($res) {
			return $id;
		}else{
			return false;
		}
	}
	
	public function get($id) {
		$res = $this->redis->cmd('HGET', 'links', $id)->get();
		return $res;
	}
	
	public function count() {
		$res = $this->redis->cmd('HLEN', 'links', $id)->get();
		return $res;
	}
	
	public function delLinkByID($id) {
		$res = $this->redis->cmd('HDEL', 'links', $id)->set();
		return $res;
	}
}