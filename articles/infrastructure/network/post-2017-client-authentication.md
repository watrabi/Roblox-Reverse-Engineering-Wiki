# Post-2017 Client Authentication (RSA-SHA1 Ticket)

*Description: RSA-SHA1 signed ticket used by Roblox clients for server authentication, circa 2017+*
*Credits: (community source)*

The client ticket is a multi-part signed token generated server-side and passed to the Roblox client to authenticate a join request. It supersedes the older [Pre-2017 Client Authentication](client-authentication) format by adding a protocol version suffix and using a formatted date string instead of a Unix timestamp.

## Format

```
{timestamp};{sig};{sig2};2
```

| Field | Description |
|-------|-------------|
| `timestamp` | Date formatted `n/j/Y g:i:s A` (e.g. `1/15/2025 3:45:12 PM`) |
| `sig` | RSA-SHA1 signature of `{id}\n{name}\n{charapp}\n{jobid}\n{timestamp}` |
| `sig2` | RSA-SHA1 signature of `{id}\n{jobid}\n{timestamp}` |
| `2` | Protocol version indicator |

## Fields

| Field | Description |
|-------|-------------|
| `id` | User ID |
| `name` | Username |
| `charapp` | Character appearance ID |
| `jobid` | Job/game instance identifier |
| `timestamp` | Generation timestamp |

## Implementation (PHP)

```php
function GenerateClientTicket($id, $name, $charapp, $jobid) {
    $sigKey = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/keys/rbxsig2_private.pem");
    $timestamp = date('n/j/Y g:i:s A');
    
    $ticket = $id . "\n" . $name . "\n" . $charapp . "\n" . $jobid . "\n" . $timestamp;
    $ticket2 = $id . "\n" . $jobid . "\n" . $timestamp;
    
    openssl_sign($ticket, $sig, $sigKey, OPENSSL_ALGO_SHA1);
    openssl_sign($ticket2, $sig2, $sigKey, OPENSSL_ALGO_SHA1);
    
    $sig = base64_encode($sig);
    $sig2 = base64_encode($sig2);
    
    return "{$timestamp};{$sig};{$sig2};2";
}
```

## Private Key

The signing key is expected at `{docroot}/keys/rbxsig2_private.pem` in PEM format. The corresponding public key (`rbxsig2_public.pem`) is embedded in the Roblox client binary for ticket verification.

## Signature Payloads

**sig** covers all five fields: `{id}\n{name}\n{charapp}\n{jobid}\n{timestamp}`

**sig2** covers three fields: `{id}\n{jobid}\n{timestamp}`

Both use RSA with SHA-1 (`OPENSSL_ALGO_SHA1`).

## Client Verification

The Roblox client:
1. Parses the ticket on `;` delimiter
2. Verifies `sig` against its embedded `rbxsig2_public.pem`
3. Verifies `sig2` for the abbreviated payload
4. Checks the protocol version suffix (`2`)

A failed signature check results in the client rejecting the connection.

## Key Differences from Pre-2017 Format

| Aspect | Pre-2017 | Post-2017 |
|--------|----------|-----------|
| Timestamp | Unix epoch | `n/j/Y g:i:s A` string |
| Algorithm | SHA-1 | RSA-SHA1 (asymmetric) |
| Protocol version | None | `;2` suffix |
| Key | Shared secret | PEM key pair (`rbxsig2_private.pem` / `rbxsig2_public.pem`) |
