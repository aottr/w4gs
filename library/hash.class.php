<?php

/**
 * Class Hash
 * Simple class to generate Hashes
 * @author staubrein <me@staubrein.com>
 * @version 0.2
 * @todo add more functionality
 */
class Hash
{

	/**
	 * Static function to create a Hash using a specified algorithm
	 * @param string $algorithm  (md5, sha512, ect)
	 * @param string $data Data to encode
	 * @param string $salt salt (e.g. specified in the config file)
	 * @return string hashed/salted data
	 */
	public static function create($algorithm, $data, $salt)
	{
		$context = hash_init($algorithm, HASH_HMAC, $salt);
		hash_update($context, $data);

		return hash_final($context);
	}
}
