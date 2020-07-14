## Create small model of a physical money wallet using Laravel Framework

* User should register and login to the system: you need to implement user registration and login flow.

* There should be 2 ways of registration: via email & via google or facebook.

* To be able to log in the user has to verify his/her account from the email he/she gets.

* When logged in for the first time user should be able to add his wallet in order to continue (think at it of UX perspective)

* Wallets should have name and type (examples: credit card, cash), note that user can add as many wallets as wanted.

* After adding wallets user should be able to add records.

* Records can be of Credit or Debit types. User should chose the wallet of which to remove or to add a specific amount.

* Don't forget to show total balance, and the balance of each wallet and update it in a separate

* Reporting section.

* Write appropriate unit tests

### REST API
http://localhost:8000/api/v1/user [get]

http://localhost:8000/api/v1/login [post]

{
    "name": "admin",
    "email": "dhiraj.patra@gmail.com",
    "password":"12345678"
}

http://localhost:8000/api/v1/register

{
    "name": "admin",
    "email": "dhiraj.patra@gmail.com",
    "password":"12345678"
}


`need to use the token with other API calling. Add this with Bearer in header`


http://localhost:8000/api/v1/wallets [get]


http://localhost:8000/api/v1/wallets [post]

{
    "name": "UPI",
    "type": "mobile payment"
}

http://localhost:8000/api/v1/wallets/{id} [get]

http://localhost:8000/api/v1/wallets/{id} [put]

{
    "id": "2",
    "name": "UPI",
    "type": "mobile payment"
}

http://localhost:8000/api/v1/wallets/{id} [delete]



http://localhost:8000/api/v1/records [get]


http://localhost:8000/api/v1/records [post]

{
    "wallet_id": "2",
    "amount": "5500",
    "type": "credit"
}

http://localhost:8000/api/v1/records/{id} [get]

http://localhost:8000/api/v1/records/{id} [put]

{
    "record_id": "2",
    "amount": "5500",
    "type": "credit"
}

http://localhost:8000/api/v1/records/{id} [delete]
