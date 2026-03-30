<?php

$dir = __DIR__ . '/database/migrations';
$files = glob($dir . '/*.php');

$schemas = [
    'create_users_table' => <<<PHP
        Schema::create('users', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->string('email')->unique();
            \$table->timestamp('email_verified_at')->nullable();
            \$table->string('password');
            \$table->rememberToken();
            \$table->foreignId('role_id')->nullable()->constrained()->nullOnDelete();
            \$table->timestamps();
        });
PHP,
    
    'create_permissions_table' => <<<PHP
        Schema::create('permissions', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name')->unique();
            \$table->timestamps();
        });
PHP,

    'create_news_categories_table' => <<<PHP
        Schema::create('news_categories', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name_th');
            \$table->string('name_en');
            \$table->timestamps();
        });
PHP,

    'create_news_table' => <<<PHP
        Schema::create('news', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('category_id')->nullable()->constrained('news_categories')->nullOnDelete();
            \$table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            \$table->string('title_th');
            \$table->string('title_en')->nullable();
            \$table->longText('content_th')->nullable();
            \$table->longText('content_en')->nullable();
            \$table->string('slug')->unique();
            \$table->boolean('is_published')->default(false);
            \$table->timestamp('published_at')->nullable();
            \$table->timestamps();
        });
PHP,

    'create_news_tags_table' => <<<PHP
        Schema::create('news_tags', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name')->unique();
            \$table->timestamps();
        });
PHP,

    'create_document_categories_table' => <<<PHP
        Schema::create('document_categories', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name_th');
            \$table->string('name_en');
            \$table->timestamps();
        });
PHP,

    'create_document_years_table' => <<<PHP
        Schema::create('document_years', function (Blueprint \$table) {
            \$table->id();
            \$table->year('year');
            \$table->timestamps();
        });
PHP,

    'create_documents_table' => <<<PHP
        Schema::create('documents', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('category_id')->constrained('document_categories')->cascadeOnDelete();
            \$table->foreignId('year_id')->nullable()->constrained('document_years')->nullOnDelete();
            \$table->string('title_th');
            \$table->string('title_en')->nullable();
            \$table->string('file_path');
            \$table->unsignedInteger('downloads')->default(0);
            \$table->timestamps();
        });
PHP,

    'create_financial_categories_table' => <<<PHP
        Schema::create('financial_categories', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name_th');
            \$table->string('name_en');
            \$table->timestamps();
        });
PHP,

    'create_financial_reports_table' => <<<PHP
        Schema::create('financial_reports', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('category_id')->constrained('financial_categories')->cascadeOnDelete();
            \$table->foreignId('year_id')->nullable()->constrained('document_years')->nullOnDelete();
            \$table->string('title_th');
            \$table->string('title_en')->nullable();
            \$table->string('file_path');
            \$table->timestamps();
        });
PHP,

    'create_event_types_table' => <<<PHP
        Schema::create('event_types', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name_th');
            \$table->string('name_en');
            \$table->timestamps();
        });
PHP,

    'create_events_table' => <<<PHP
        Schema::create('events', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('event_type_id')->nullable()->constrained('event_types')->nullOnDelete();
            \$table->string('title_th');
            \$table->string('title_en')->nullable();
            \$table->text('description_th')->nullable();
            \$table->text('description_en')->nullable();
            \$table->timestamp('event_start');
            \$table->timestamp('event_end')->nullable();
            \$table->string('location')->nullable();
            \$table->string('document_path')->nullable();
            \$table->timestamps();
        });
PHP,

    'create_board_directors_table' => <<<PHP
        Schema::create('board_directors', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name_th');
            \$table->string('name_en')->nullable();
            \$table->string('position_th');
            \$table->string('position_en')->nullable();
            \$table->text('biography_th')->nullable();
            \$table->text('biography_en')->nullable();
            \$table->string('image_path')->nullable();
            \$table->unsignedInteger('display_order')->default(0);
            \$table->timestamps();
        });
PHP,

    'create_management_teams_table' => <<<PHP
        Schema::create('management_teams', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name_th');
            \$table->string('name_en')->nullable();
            \$table->string('position_th');
            \$table->string('position_en')->nullable();
            \$table->string('image_path')->nullable();
            \$table->unsignedInteger('display_order')->default(0);
            \$table->timestamps();
        });
PHP,

    'create_shareholding_structures_table' => <<<PHP
        Schema::create('shareholding_structures', function (Blueprint \$table) {
            \$table->id();
            \$table->string('shareholder_name_th');
            \$table->string('shareholder_name_en')->nullable();
            \$table->unsignedBigInteger('number_of_shares');
            \$table->decimal('percentage', 5, 2);
            \$table->date('as_of_date')->nullable();
            \$table->timestamps();
        });
PHP,

    'create_governance_documents_table' => <<<PHP
        Schema::create('governance_documents', function (Blueprint \$table) {
            \$table->id();
            \$table->string('title_th');
            \$table->string('title_en')->nullable();
            \$table->string('file_path');
            \$table->string('version')->nullable();
            \$table->date('effective_date')->nullable();
            \$table->timestamps();
        });
PHP,

    'create_contact_messages_table' => <<<PHP
        Schema::create('contact_messages', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->string('email');
            \$table->string('phone')->nullable();
            \$table->text('message');
            \$table->boolean('is_resolved')->default(false);
            \$table->timestamps();
        });
PHP,

    'create_media_libraries_table' => <<<PHP
        Schema::create('media_libraries', function (Blueprint \$table) {
            \$table->id();
            \$table->string('file_name');
            \$table->string('file_path');
            \$table->string('mime_type');
            \$table->unsignedBigInteger('size');
            \$table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            \$table->timestamps();
        });
PHP,

    'create_permission_role_table' => <<<PHP
        Schema::create('permission_role', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('permission_id')->constrained()->cascadeOnDelete();
            \$table->foreignId('role_id')->constrained()->cascadeOnDelete();
            \$table->timestamps();
        });
PHP,

    'create_news_news_tag_table' => <<<PHP
        Schema::create('news_news_tag', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('news_id')->constrained()->cascadeOnDelete();
            \$table->foreignId('news_tag_id')->constrained()->cascadeOnDelete();
            \$table->timestamps();
        });
PHP,
];

foreach ($files as $file) {
    if (strpos($file, 'create_password_reset_tokens_table') !== false ||
        strpos($file, 'create_personal_access_tokens_table') !== false ||
        strpos($file, 'create_password_resets_table') !== false ||
        strpos($file, 'create_failed_jobs_table') !== false ||
        strpos($file, 'create_jobs_table') !== false) {
        continue;
    }

    $content = file_get_contents($file);
    $updated = false;
    foreach ($schemas as $tableName => $schemaMethod) {
        if (strpos($file, $tableName) !== false) {
            // Find "Schema::create('...'" up to "});"
            // Use regex to replace the content inside Schema::create closure completely.
            $pattern = "/Schema::create\('([^']+)',\s*function\s*\(Blueprint\s*\\\$table\)\s*\{(.*?)\}\);/s";
            
            $content = preg_replace($pattern, trim($schemaMethod), $content);
            file_put_contents($file, $content);
            echo "Updated: " . basename($file) . "\n";
            $updated = true;
            break;
        }
    }
}
