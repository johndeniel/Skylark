# Skylark

A high-performance Laravel application optimized for scalability, utilizing `MongoDB` as a schema-flexible, document-oriented database and `AWS S3` for reliable, distributed object storage of media and static assets.

### Prerequisites

- PHP >= 8.x
- Composer
- Laravel
- MongoDB PHP Extension
- MongoDB server (local or remote)
- AWS S3 bucket with IAM credentials



### Copy .env.example and update the following settings

```env
# Application Configuration
APP_NAME="Skylark"
APP_KEY=
APP_URL=https://yourdomain.com

# Database Configuration
DB_CONNECTION=mongodb
DB_DATABASE=your_database_name
DB_URI=mongodb://username:password@host:port/database

# AWS S3 Configuration
AWS_ACCESS_KEY_ID=your_aws_access_key_id
AWS_SECRET_ACCESS_KEY=your_aws_secret_access_key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your_s3_bucket_name
```

### Generate a new application key for security
```bash
php artisan key:generate
```
### Edit the AWS-S3 Bucket Policy
```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "PublicReadGetObject",
            "Effect": "Allow",
            "Principal": "*",
            "Action": [
                "s3:GetObject",
                "s3:PutObject",
                "s3:DeleteObject",
                "s3:PutObjectAcl"
            ],
            "Resource": "arn:aws:s3:::your-bucket-name/*"
        }
    ]
}
```

---

### Common Artisan Commands
```bash
php artisan serve                     # Start the local development server
php artisan config:cache              # Cache the configuration files for improved performance
php artisan migrate                   # Run outstanding database migrations
php artisan migrate:refresh           # Roll back and re-run all migrations
php artisan migrate:refresh --seed    # Roll back and re-run all migrations, then seed the database

```