# Wallets-Africa

PHP implementation of Wallets Africa (https://wallets.africa) API

# Introduction

All the APIs on the platform were implemented as four main classes:

1) Payout - for transfer of money instantly to bank accounts in Nigeria and mobile money accounts in Ghana and Kenya.

2) Wallet - for management of wallet accounts (sub wallets created from the main or base wallet) programatically by creating, crediting and debiting of user accounts.

3) Identity - for verifying the identity of customers with their Bank Verification Number (BVN) implemented by the Central Bank of Nigeria.

4) Airtime - for painless Top up of customers airtime. Get fast online recharges for all the mobile networks in Nigeria.

# Usage 

The usage of this library is pretty straight forward. Simply create a dot env file using the dot env example provided and you are good to go. Remember to change the values where necessary most especially the api keys.