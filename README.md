# Online Test PT. Digdaya Olah Teknologi (DOT) Indonesia

This project is made by Nisrina Fadhilah Fano as a online test for the recruitment process at PT. Digdaya Olah Teknologi (DOT) Indonesia as a Freelance Backend PHP.

<b>Framework: Laravel 8.83.27</b>

<b>Prequisites:</b>
- XAMPP with PHP version >= 7.3
- Postman

## Steps to run this project in local environment:
0. Start Apache and MySQL server
1. Clone this project inside xampp/htdocs folder
2. Copy `.env.example` file and rename the new file to `.env`
3. Create a new database and change the value of `DB_DATABASE` with your database name
4. Open terminal, navigate to this project folder
5. Run `php artisan migrate` to create the table
6. Run `php artisan serve` to start
7. Now you're ready to test the REST API with Postman

## Steps to test Sprint 1
1. Check in the database, there should be 2 tables named province and city. Make sure the tables are empty.
2. Run `php artisan fetch:province` to fetch province data from Rajaongkir
3. Run `php artisan fetch:city` to fetch city data from Rajaongkir
4. Test the REST API using Postman. Here is the example requests:

- [GET] /api/search/provinces?id={id}
- [GET] /api/search/cities?id={id}