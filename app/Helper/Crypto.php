<?php

namespace App\Helper;

/**
 * Encryption Handler
 */
class Crypto
{
	/**
	 * Encryption algorithm
	 * 
	 * @return string
	 */
	private static function getAlgo()
	{
		return "aes-256-cbc";
	}

	/**
	 * Encryption Sault
	 * 
	 * @return string
	 */
	private static function getSault()
	{
		return "5NJ0ZaQVaE%co&#ip#!hd8JS0Ks*y&Oo";
	}

	/**
	 * Encryption Iv
	 * 
	 * @return string
	 */
	private static function getIv()
	{
		return "o63Y%Ig8qIhkMOjP";
	}

	/**
	 * Decrypt a giver encrypted string
	 * 
	 * @param string	$string
	 * @return string
	 */
	public static function decrypt($string)
	{
		return openssl_decrypt($string, self::getAlgo(), self::getSault(), 0, self::getIv(0));
	}

	/**
	 * Decrypt a giver encrypted string from base64
	 * 
	 * @param string	$string
	 * @return string
	 */
	public static function decryptFromBase64($string)
	{
		return self::decrypt(base64_decode($string));
	}
}
