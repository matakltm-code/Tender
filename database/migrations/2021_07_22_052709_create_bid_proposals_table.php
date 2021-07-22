<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_proposals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); // bidders id
            $table->integer('notice_id');
            $table->decimal('initial_payment');
            $table->text('bid_advantage');
            $table->text('file_path');
            // $table->boolean('is_win')->default(false); // True if this proposal is win
            $table->boolean('winner_pt_status')->default(false); // Display for the bidder if pt make this it true
            $table->boolean('assessed_pac_status')->default(false); // pac can change => if this is true then pt user can see and pt user will also notify winner(= the the winner will be winner_pt_status column as true)
            $table->boolean('is_pac_evaluated')->default(false); // this will use for pac to display as evaluated proposal list or not
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bid_proposals');
    }
}
