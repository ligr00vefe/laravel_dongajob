<?php

namespace App\Models;

use App\Classes\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Laborer extends Model
{
    use HasFactory;

    public static function add($request)
    {

        $result = DB::table('laborers')->insert(
            [
                "name" => $request->input("name"),
                "rsNo" => $request->input("rsNo"),
                "target_id" => $request->input("target_id"),
                "business_type" => $request->input("business_type"),
                "grade" => $request->input("grade"),
                "sigungu_name" => $request->input("sigungu_name"),
                "service_sigungu_name" => $request->input("service_sigungu_name"),
                "tel" => $request->input("tel"),
                "phone" => $request->input("phone"),
                "contract_status" => $request->input("contract_status"),
                "contract_start_date" => $request->input("contract_start_date"),
                "contract_end_date" => $request->input("contract_end_date"),
                "contract_resign_reason" => $request->input("contract_resign_reason"),
                "service_status" => $request->input("service_status"),
                "service_start_date" => $request->input("service_start_date"),
                "service_end_date" => $request->input("service_end_date"),
                "service_resign_date" => $request->input("service_resign_date"),
                "target_helper" => $request->input("target_helper"),
                "help_price_total" => $request->input("help_price_total"),
                "government_help_price" => $request->input("government_help_price"),
                "deductible" => $request->input("deductible"),
                "childbirth_date" => $request->input("childbirth_date"),
                "leave_hospital_date" => $request->input("leave_hospital_date"),
                "zip_code" => $request->input("zip_code"),
                "service_address" => $request->input("service_address"),
                "address" => $request->input("address"),
                "address_detail" => $request->input("address_detail"),
            ]
        );

        return $result;
    }
}
