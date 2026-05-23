# Roblox API Reference (legacy)

*Credits: lrre.wiki (archived from web.archive.org capture of api.roblox.com/docs, July 11 2017)*

Documentation for the legacy `api.roblox.com` REST endpoints. Base URL: `http://api.roblox.com`

---

## Assets

### `GET /assets/{id}/versions`
Retrieves asset information for the specified asset ID. The authenticated user must be able to manage the asset.

| Parameter | Type | Description |
|-----------|------|-------------|
| id | long | The ID of the asset |
| placeId | (none) | The ID of the place |
| page | int | (Optional) The page to retrieve |

```json
[{
  "Id": 536133191,
  "AssetId": 226132918,
  "VersionNumber": 3,
  "RawContentId": 2619739106,
  "ParentAssetVersionId": 536132109,
  "CreatorType": 1,
  "CreatorTargetId": 80502178,
  "CreatingUniverseId": null,
  "Created": "2015-07-13T11:51:12.9073098-05:00",
  "Updated": "2015-07-13T11:51:12.9073098-05:00"
}]
```

| Error | Description |
|-------|-------------|
| 409 | Platform exception |

### `POST /assets/award-badge`
Award a badge to a user.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |
| badgeId | long | The ID of the badge |
| placeId | long | The ID of the place |

Returns: `{userName} won {badgeCreatorName}'s "{badgeName}" award!`

| Error | Description |
|-------|-------------|
| 0 | Platform exception |

---

## Clans

### `GET /clans/get-by-user`
Retrieves clan information for the specified user ID.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |

```json
{ "Id": 123456, "Name": "Clan Name", "EmblemAssetId": 123456789 }
```

### `GET /clans/get-by-id`
Retrieves clan information for the specified clan ID.

| Parameter | Type | Description |
|-----------|------|-------------|
| clanId | int | The ID of the clan |

```json
{ "Id": 123456, "Name": "Clan Name", "EmblemAssetId": 123456789 }
```

---

## Currency

### `GET /currency/balance`
Returns the Robux and Ticket balances for the currently authenticated user.

```json
{ "robux": 10, "tickets": 150 }
```

| Error | Description |
|-------|-------------|
| - | ApplicationException: Invalid auth token |

### `GET /my/platform-currency-budget`
No description available.

### `GET /my/economy-status`
Get not only the balance info but also the status of the economy.

```json
{
  "robux": 0,
  "tickets": 150,
  "isMarketplaceEnabled": true,
  "isDeveloperProductPurchaseEnabled": true,
  "areInAppPurchasesEnabled": true
}
```

| Error | Description |
|-------|-------------|
| - | ApplicationException: Invalid auth token |

---

## Friends

### `GET /users/{userId}/friends`
Retrieves a paged list of friends for the specified user.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |
| page | int | (Optional) The page to retrieve |

```json
[{
  "Id": 12345678,
  "Username": "user",
  "AvatarUri": "",
  "AvatarFinal": true,
  "IsOnline": true
}]
```

### `POST /user/accept-friend-request`
Accept a friend request.

| Parameter | Type | Description |
|-----------|------|-------------|
| requesterUserId | int | The ID of the requester |

```json
{ "success": true, "message": "Success" }
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid requesterUserId |
| 404 | Resource Not found: Not enabled |

### `POST /user/decline-friend-request`
Decline a friend request.

| Parameter | Type | Description |
|-----------|------|-------------|
| requesterUserId | int | The ID of the requester |

```json
{ "success": true, "message": "Success" }
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid requesterUserId |
| 404 | Resource Not Found: Not enabled |

### `POST /user/request-friendship`
Send a friend request to the specified user.

| Parameter | Type | Description |
|-----------|------|-------------|
| recipientUserId | int | The userId of the recipient |

```json
{ "success": true, "message": "Success" }
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid recipientUserId |
| 404 | Resource Not Found: Not enabled |

### `GET /user/get-friendship-count`
Get number of friends.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | (Optional) The ID of the user, or the authenticated user if not provided |

```json
{ "success": true, "message": "Success", "count": 10 }
```

| Error | Description |
|-------|-------------|
| 404 | Resource Not Found: Not enabled |

### `POST /user/unfriend`
UnFriend a user.

| Parameter | Type | Description |
|-----------|------|-------------|
| friendUserId | int | The ID of the friend |

```json
{ "success": true, "message": "Success" }
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid friendUserId |
| 404 | Not Found: Not enabled |

### `GET, POST /friends/filter`
Get any friends of the current user from a list of userIds.

| Parameter | Type | Description |
|-----------|------|-------------|
| otherUserIds | List\<int\> | The list of IDs of users to be checked for friendship |

```json
[{
  "Id": 12345678,
  "Username": "user",
  "AvatarUri": "http://",
  "AvatarFinal": false,
  "IsOnline": true
}]
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid userId/Too many users to be filtered |
| 404 | Not Found: Not enabled |

### `GET /user/following-exists`
Returns whether followerUserId is following userId.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The user potentially being followed |
| followerUserId | int | The user potentially following the other user |

```json
{ "success": true, "message": "Success", "isFollowing": true }
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid followerUserId/Invalid userId |
| 404 | Not Found: Not enabled |

### `GET, POST /friends/filter-requests`
Get any pending friend requests between the current user and a list of userIds.

| Parameter | Type | Description |
|-----------|------|-------------|
| otherUserIds | List\<int\> | UserIds of other users to check. Max 100 |

```json
{
  "FriendRequestsFromUser": [{ "SenderId": 12345678, "RecipientId": 87654321 }],
  "FriendRequestsToUser": [{ "SenderId": 98765432, "RecipientId": 12345678 }]
}
```

### `POST /user/follow`
Follow a particular user.

| Parameter | Type | Description |
|-----------|------|-------------|
| followedUserId | int | The ID of the user to follow |

```json
{ "success": true, "message": "Success" }
```

| Error | Description |
|-------|-------------|
| 400 | Invalid followerUserId |
| 403 | Block exists between authenticated user and followedUserId |
| 404 | Not enabled |

### `POST /user/unfollow`
UnFollow a particular user.

| Parameter | Type | Description |
|-----------|------|-------------|
| followedUserId | int | The ID of the followed user |

```json
{ "success": true, "message": "Success" }
```

| Error | Description |
|-------|-------------|
| 400 | Invalid followerUserId |
| 404 | Not enabled |

### `GET /users/followers`
Get the list of followers for a particular user.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |
| page | int | (Optional) The page to be retrieved |
| imageWidth | int | (Optional) The width of the followers' images |
| imageHeight | int | (Optional) The height of the followers' images |
| imageFormat | string | (Optional) The format of the images |

```json
[{
  "Id": 12345678,
  "Username": "user",
  "AvatarUri": "http://",
  "AvatarFinal": false,
  "IsOnline": true
}]
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid userId/Invalid page number |
| 404 | Not Found: Not enabled |

### `GET /users/followings`
Get the list of followings for the current user.

| Parameter | Type | Description |
|-----------|------|-------------|
| page | int | (Optional) The page to be retrieved |
| imageWidth | int | (Optional) The width of the followers' images |
| imageHeight | int | (Optional) The height of the followers' images |
| imageFormat | string | (Optional) The format of the followers' images |

```json
[{
  "Id": 12345678,
  "Username": "user",
  "AvatarUri": "http://",
  "AvatarFinal": false,
  "IsOnline": false
}]
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid userId/Invalid page number |
| 404 | Not Found: not enabled |

---

## Groups

### `GET /users/{userId}/groups`
Lists a user's groups.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |

```json
[{
  "Id": 696519,
  "Name": "Orinthians",
  "EmblemId": 135321582,
  "EmblemUrl": "http://www.roblox.com/asset/?id=135321582",
  "Rank": 254,
  "Role": "Council",
  "IsInClan": false,
  "IsPrimary": false
}, {
  "Id": 679727,
  "Name": "ROBLOX Community Staff and Forum Users",
  "EmblemId": 90708870,
  "EmblemUrl": "http://www.roblox.com/asset/?id=90708870",
  "Rank": 245,
  "Role": "Other Staff",
  "IsInClan": false,
  "IsPrimary": false
}]
```

| Error | Description |
|-------|-------------|
| 404 | User not found |

### `GET /groups/{groupId}`
Retrieves information for the specified group ID.

| Parameter | Type | Description |
|-----------|------|-------------|
| groupId | int | The ID of the group |

```json
{
  "Name": "Group name",
  "Id": 1234567,
  "Owner": { "Name": "owner", "Id": 12345678 },
  "EmblemUrl": "http://www.roblox.com/asset/?id=12345678",
  "Description": "",
  "Roles": [{ "Name": "Panem Citizens", "Rank": 1 }]
}
```

| Error | Description |
|-------|-------------|
| 404 | Group not found |
| 503 | Get group info not enabled |

### `GET /groups/{groupId}/allies`
Retrieves a paged list of allied groups.

| Parameter | Type | Description |
|-----------|------|-------------|
| groupId | int | The ID of the group |
| page | int | (Optional) The page to retrieve |

```json
{
  "Groups": [{
    "Name": "",
    "Id": 123456,
    "Owner": { "Name": "", "Id": 23456789 },
    "EmblemUrl": "http://www.roblox.com/asset/?id=189284884",
    "Description": "",
    "Roles": [{ "Name": "Advisor", "Rank": 1 }]
  }],
  "FinalPage": true
}
```

### `GET /groups/{groupId}/enemies`
Retrieves a paged list of enemy groups.

| Parameter | Type | Description |
|-----------|------|-------------|
| groupId | int | The ID of the group |
| page | int | (Optional) The page to retrieve |

```json
{
  "Groups": [{
    "Name": "",
    "Id": 123456,
    "Owner": { "Name": "", "Id": 23456789 },
    "EmblemUrl": "http://www.roblox.com/asset/?id=189284884",
    "Description": "",
    "Roles": [{ "Name": "Advisor", "Rank": 1 }]
  }],
  "FinalPage": true
}
```

---

## IncomingItems

### `GET /incoming-items/counts`
Get number of incoming items.

```json
{ "unreadMessageCount": 1, "friendRequestsCount": 2 }
```

| Error | Description |
|-------|-------------|
| 403 | Forbidden |

---

## Marketplace

### `GET /marketplace/productinfo`
Returns the product info for the specified asset.

| Parameter | Type | Description |
|-----------|------|-------------|
| assetId | int | The ID of the asset |

```json
{
  "AssetId": 123456789,
  "ProductId": 24870409,
  "Name": "Hat",
  "Description": "",
  "AssetTypeId": 8,
  "Creator": { "Id": 1, "Name": "ROBLOX" },
  "IconImageAssetId": 0,
  "Created": "2015-06-25T20:07:49.147Z",
  "Updated": "2015-07-11T20:07:51.863Z",
  "PriceInRobux": 350,
  "PriceInTickets": null,
  "Sales": 0,
  "IsNew": true,
  "IsForSale": true,
  "IsPublicDomain": false,
  "IsLimited": false,
  "IsLimitedUnique": false,
  "Remaining": null,
  "MinimumMembershipLevel": 0,
  "ContentRatingTypeId": 0
}
```

---

## Ownership

### `GET /ownership/hasasset`
Checks if a user owns the specified asset.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |
| assetId | long | The ID of the asset |

Returns: `true` or `false`

---

## Reference

### `GET /reference/deviceinfo`
Get device info.

```json
{
  "PlatformType": "platform name",
  "DeviceType": "device type",
  "OperatingSystemType": "OS type"
}
```

---

## SignOut

### `POST /sign-out/v1`
Logs out the authenticated user.

| Status | Description |
|--------|-------------|
| 200 | The user was successfully signed out |
| 403 | The request did not include a valid XSRF token. A new token will be included in the response headers |
| 500 | An internal server error occurred |

---

## UserBlock

### `POST /userblock/block`
Block a user; prevent communication between the current user and the specified user.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | UserId of the user to be blocked |

```json
{ "success": true }
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid user id |

### `POST /userblock/unblock`
Unblock a user; allow communication between the current user and the specified user.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | UserId of the user to be unblocked |

```json
{ "success": true }
```

| Error | Description |
|-------|-------------|
| 400 | Bad Request: Invalid user id |

---

## Users

### `GET /users/{userId}`
Retrieves user information for the specified user ID.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |

```json
{ "Id": 12345678, "Username": "user name" }
```

### `GET /users/get-by-username`
Retrieves user information for the specified username.

| Parameter | Type | Description |
|-----------|------|-------------|
| username | string | The name of the user |

```json
{ "Id": 12345678, "Username": "user name" }
```

| Error | Description |
|-------|-------------|
| - | Invalid username |
| - | User not found |

### `GET /users/{userId}/canmanage/{assetId}`
Returns whether the user can manage a given asset.

| Parameter | Type | Description |
|-----------|------|-------------|
| userId | int | The ID of the user |
| assetId | long | The ID of the asset |

```json
{ "Success": true, "CanManage": false }
```

| Error | Description |
|-------|-------------|
| - | Not enabled |
| - | Unknown user or asset |
