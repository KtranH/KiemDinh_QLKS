<?php

namespace Tests\Unit;

use App\Models\KhachThue;
use App\QueryDB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tests\TestCase;

class BookingCheckinTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use QueryDB;
    use HasFactory;
    public function test_find_customer_exists() {
        $testkh = KhachThue::factory()->create([
            'CMND' => '001089113111'
        ]);
        $result = $this->Find_Customer('001089113111');
        $this->assertNotFalse($result);
    }
    
    public function test_find_customer_not_exists() {
        $result = $this->Find_Customer('987654321000');
        $this->assertFalse($result);
    }
    
    public function test_find_customer_empty_cmnd() {
        $result = $this->Find_Customer('');
        $this->assertFalse($result);
    }
    public function test_number_of_days_valid() {
        $days = $this->Number_Of_Days_InHotel('2024-10-20', '2024-10-25');
        $this->assertEquals(5, $days);
    }
    
    public function test_number_of_days_checkout_before_checkin() {
        $days = $this->Number_Of_Days_InHotel('2024-10-20', '2024-10-15');
        $this->assertEquals(0, $days);
    }
    
    public function test_number_of_days_same_day() {
        $days = $this->Number_Of_Days_InHotel('2024-10-20', '2024-10-20');
        $this->assertEquals(0, $days);
    }
    public function test_check_exist_customer_cmnd_and_phone_exist()
    {
        $khachThue = KhachThue::factory()->create([
            'CMND' => '001089123456',
            'SDT' => '0987654321',
        ]);

        $result = $this->Check_Exist_Customer('001089123456', '0987654321');

        $this->assertFalse($result);
    }
    public function test_check_exist_customer_cmnd_not_exist_phone_exist()
    {
        $khachThue = KhachThue::factory()->create([
            'CMND' => '111089123456',
            'SDT' => '0987654321',
        ]);

        $result = $this->Check_Exist_Customer('100089123456', '0987654321');

        $this->assertFalse($result);
    }
    public function test_check_exist_customer_cmnd_exist_phone_not_exist()
    {
        $khachThue = KhachThue::factory()->create([
            'CMND' => '001089123456',
            'SDT' => '0909123456',
        ]);

        $result = $this->Check_Exist_Customer('001089123456', '0999123456');
        $this->assertFalse($result);
    }
    public function test_check_exist_customer_cmnd_and_phone_not_exist()
    {
        $result = $this->Check_Exist_Customer('00987654321', '0912345678');
        $this->assertTrue($result);
    }
    public function test_check_capacity_room_available() {
        $result = $this->Check_Capacity(2, '670fa034d5595dd17d06dfb2');
        $this->assertTrue($result);
    }
    
    public function test_check_capacity_room_full() {
        $result = $this->Check_Capacity(2, '6717ac0f1f698f110a0bc372');
        $this->assertFalse($result);
    }
    public function test_check_capacity_id_not_found()
    {
        $exceptionThrown = false;
    
        try {
            $this->Check_Capacity(2, '611111b1ba8d93eb0304af6d');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $exceptionThrown = true;
        }
        
        $this->assertTrue($exceptionThrown, 'Expected ModelNotFoundException was not thrown');
    }
    public function test_check_customer_exist_in_checkin_exists() {
        $result = $this->Check_Customer_Exist_InCheckin('45646789412', '6717ac0f1f698f110a0bc372');
        $this->assertFalse($result);
    }
    
    public function test_check_customer_exist_in_checkin_not_exists() {
        $result = $this->Check_Customer_Exist_InCheckin('079192345678', '670fa034d5595dd17d06dfb2');
        $this->assertTrue($result);
    }
    public function test_check__customer_exist_in_checkin_id_not_found()
    {
        $exceptionThrown = false;
    
        try {
            $this->Check_Customer_Exist_InCheckin('079192345678', '611111b1ba8d93eb0304af6d');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $exceptionThrown = true;
        }
        
        $this->assertTrue($exceptionThrown, 'Expected ModelNotFoundException was not thrown');
    }
}
