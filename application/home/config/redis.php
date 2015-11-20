<?php
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/10/19
 * Time: 10:12
 */
$config['socket_type'] = 'tcp'; //`tcp` or `unix`
$config['socket'] = '/var/run/redis.sock'; // in case of `unix` socket type
$config['host'] = '127.0.0.1';
$config['password'] = NULL;
$config['port'] = 6379;
$config['timeout'] = 0;