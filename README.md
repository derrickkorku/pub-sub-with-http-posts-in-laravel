## About Project

This project demonstrates how to perform pub/sub messages using http posts in Laravel 8

## Setup

- Create database in your database server
- Setup database connection in your .env


## How to test
- Run php artisan serve
- POST {url: "valid url to accept post requests from publisher "}  to /api/subscribe/{topic}. {topic} values restricted to topic1, topic2, topic3
- POST {message: "Messages to broadcast"}  to /api/publish/{topic}. {topic} values restricted to topic1, topic2, topic3
- Run "php artisan broadcast:messages" to broadcast messsages to subscribers. The artisan command is also scheduled to be ran by cron every minute. The schedule time can be modified appropriately. The command can also be ran using jobs


