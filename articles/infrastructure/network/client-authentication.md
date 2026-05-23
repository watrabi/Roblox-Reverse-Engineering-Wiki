# Pre-2017 Client Authentication (Tickets)

*Credits: lrre.wiki (original documentation)*

Client tickets are integral for authenticating clients in the 2016 client. This is the older format using Unix timestamps and lacking a protocol version suffix — superseded by the post-2017 RSA-SHA1 ticket format (see [Post-2017 Client Authentication](post-2017-client-authentication)).

## Signature 1 Format

Entry Type | User ID | Username | CharacterAppearance URL | Job ID | Unix Timestamp

Example: `1 | "Player" | "<url>" | 1 | 1138516781`

## Signature 2 Format

Entry Type | User ID | Job ID | Unix Timestamp

Example: `1 | 1 | 1138516781`

Entries are delimited by newlines. Signatures are SHA-1 signed.

## Final Format

Semicolon-delimited:
`UnixTimestamp;Signature1(SHA-1+Base64);Signature2(SHA-1+Base64)`

Must use `SetIsPlayerAuthenticationRequired(true)` on NetworkServer to enable.
