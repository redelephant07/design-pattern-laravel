<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the 'followers' table
        Schema::create('followers', function (Blueprint $table) {
            // Auto-incremental primary key
            $table->id();

            // Foreign key: user_id references 'id' column in 'users' table
            $table->unsignedBigInteger('user_id')->comment('The user who is being followed');

            // Foreign key: follower_id references 'id' column in 'users' table
            $table->unsignedBigInteger('follower_id')->comment('The user who is following');

            // Timestamps for 'created_at' and 'updated_at'
            $table->timestamps();

            // Unique constraint on the combination of 'user_id' and 'follower_id'
            $table->unique(['user_id', 'follower_id'], 'unique_user_follower')->comment('Ensure a user can be followed only once by another user');

            // Foreign key constraint: user_id references 'id' in 'users' table, with cascade delete
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->comment('Cascade delete if the user is deleted');

            // Foreign key constraint: follower_id references 'id' in 'users' table, with cascade delete
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade')->comment('Cascade delete if the follower is deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the 'followers' table if it exists
        Schema::dropIfExists('followers');
    }
}
