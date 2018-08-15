<?php

namespace OAuth2;

class ExpirationUtil
{
    /**
     * @param \DateTimeInterface $expiresAt
     * @param \DateTimeInterface|null $now
     * @return bool
     */
    static public function isExpired(\DateTimeInterface $expiresAt, \DateTimeInterface $now = null)
    {
        return ($now ?: \date_create()) > $expiresAt;
    }

    /**
     * @param int $seconds
     * @param \DateTimeImmutable|null $now
     * @return \DateTimeImmutable|false
     * @throws \Exception
     */
    static public function expiresAfterSeconds($seconds, \DateTimeImmutable $now = null)
    {
        $now = $now ?: \date_create_immutable();

        return $now->add(new \DateInterval('PT' . (int) $seconds . 'S'));
    }
}