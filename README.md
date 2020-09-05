Password Stretcher PBKDF2
=============================

Passwords are "hashed" with PBKDF2 (64,000 iterations of
SHA1 by default) using a cryptographically-random salt.

Usage
------

To create a hash, when a new account is added to your system, you call the
`CreateHash()` method provided by this library. To verify a password, you call
`VerifyPassword()` method provided by this library.

Customization
--------------

Each implementation provides several constants that can be changed. **Only
change these if you know what you are doing, and have help from an expert**:

- `PBKDF2_HASH_ALGORITHM`: The hash function PBKDF2 uses. By default, it is SHA1
  for compatibility across implementations, but you may change it to SHA256 if
  you don't care about compatibility. Although SHA1 has been cryptographically
  broken as a collision-resistant function, it is still perfectly safe for
  password storage with PBKDF2.

- `PBKDF2_ITERATIONS`: The number of PBKDF2 iterations. By default, it is
  32,000. To provide greater protection of passwords, at the expense of needing
  more processing power to validate passwords, increase the number of
  iterations. The number of iterations should not be decreased.

- `PBKDF2_SALT_BYTES`: The number of bytes of salt. By default, 24 bytes, which
  is 192 bits. This is more than enough. This constant should not be changed.

- `PBKDF2_HASH_BYTES`: The number of PBKDF2 output bytes. By default, 18 bytes,
  which is 144 bits. While it may seem useful to increase the number of output
  bytes, doing so can actually give an advantage to the attacker, as it
  introduces unnecessary (avoidable) slowness to the PBKDF2 computation. 144
  bits was chosen because it is (1) Less than SHA1's 160-bit output (to avoid
  unnecessary PBKDF2 overhead), and (2) A multiple of 6 bits, so that the base64
  encoding is optimal.

Note that these constants are encoded into the hash string when it is created
with `CreateHash` so that they can be changed without breaking existing hashes.
The new (changed) values will apply only to newly-created hashes.

Hash Format
------------

The hash format is five fields separated by the colon (':') character.

```
algorithm:iterations:hashSize:salt:hash
```

Where:

- `algorithm` is the name of the cryptographic hash function ("sha1").
- `iterations` is the number of PBKDF2 iterations ("64000").
- `hashSize` is the length, in bytes, of the `hash` field (after decoding).
- `salt` is the salt, base64 encoded.
- `hash` is the PBKDF2 output, base64 encoded. It must encode `hashSize` bytes.

Here are some example hashes (all of the password "foobar"):

```
sha1:64000:18:B6oWbvtHvu8qCgoE75wxmvpidRnGzGFt:R1gkPOuVjqIoTulWP1TABS0H
sha1:64000:18:/GO9XQOPexBFVzRjC9mcOkVEi7ZHQc0/:0mY83V5PvmkkHRR41R1iIhx/
sha1:64000:18:rxGkJ9fMTNU7ezyWWqS7QBOeYKNUcVYL:tn+Zr/xo99LI+kSwLOUav72X
sha1:64000:18:lFtd+Qf93yfMyP6chCxJP5nkOxri6Zbh:B0awZ9cDJCTdfxUVwVqO+Mb5
```

More Information
-----------------

For more information on secure password storage, see [Crackstation's page on
Password Hashing Security](https://crackstation.net/hashing-security.htm).
