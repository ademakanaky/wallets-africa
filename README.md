# Wallets-Africa

PHP implementation of Wallets Africa (https://wallets.africa) API

Introduction

Four major APIs on the platform were implemented as four main classes:

Payout - for transfer of money instantly to bank accounts in Nigeria and mobile money accounts in Ghana and Kenya.
Wallets - for management of wallet accounts programatically by creating, crediting and debiting of user accounts.
Identity - for verifying the identity of customers with their Bank Verification Number (BVN) implemented by the Central Bank of Nigeria.
Airtime - for painless Top up of customers airtime. Get fast online recharges for all the mobile networks in Nigeria.
Usage The usage of this library is pretty straight forward. Simply create a dot env file using the dot env example provided and you are good to go. Remember to change the values where necessary most especially the api keys.