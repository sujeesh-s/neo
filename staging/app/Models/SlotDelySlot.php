<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotDelySlot extends Model{
    use HasFactory;
    protected $table = 'dly_slot_delivery_slots';
    protected $fillable = ['slot_name','name_cnt_id','start_time','end_time','is_active','created_by','updated_by'];
    
}
