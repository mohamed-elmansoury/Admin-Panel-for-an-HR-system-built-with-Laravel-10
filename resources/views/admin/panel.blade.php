@extends('layouts.admin')
@section('title')
الضبط العام للنظام
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('adminSittings') }}"> الضبط العام</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات الضبط العام للنظام </h3>
      </div>
      <div class="card-body">
         @if(@isset($data) and !@empty($data))
         <table id="example2" class="table table-bordered table-hover">
            <tr>
               <td class="width30">اسم الشركة</td>
               <td> {{ $data['company_name'] }}</td>
            </tr>
            <tr>
               <td class="width30"> حالة التفعيل</td>
               <td> @if($data['system_status']==1) مفعل@else معطل  @endif</td>
            </tr>
            <tr>
               <td class="width30">هاتف الشركة</td>
               <td> {{ $data['phones'] }}</td>
            </tr>
            <tr>
               <td class="width30">عنوان الشركة</td>
               <td> {{ $data['address'] }}</td>
            </tr>
            <tr>
               <td class="width30">بريد الشركة</td>
               <td> {{ $data['email'] }}</td>
            </tr>
            <tr>
               <td class="width30"> بعد كم دقيقة نحسب تاخير حضور	</td>
               <td> {{ $data['after_minute_calculate_delay']*1  }}</td>
            </tr>
            <tr>
               <td class="width30"> بعد كم دقيقة نحسب انصراف مبكر	</td>
               <td> {{ $data['after_minute_calculate_early_departure']*1 }}</td>
            </tr>
            <tr>
               <td class="width30"> بعد كم دقيقه مجموع الانصراف المبكر او الحضور المتأخر نحصم ربع يوم	</td>
               <td> {{ $data['after_minute_quarterday'] *1}}</td>
            </tr>
            <tr>
               <td class="width30"> بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم	</td>
               <td> {{ $data['after_time_half_deduct']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل	</td>
               <td> {{ $data['after_time_allday_deduct']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">رصيد اجازات الموظف الشهري	</td>
               <td> {{ $data['monthly_vacation_balance']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">بعد كم يوم ينزل للموظف رصيد اجازات	</td>
               <td> {{ $data['after_days_begin_vacation']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف	</td>
               <td> {{ $data['first_balance_begin_vacation']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">قيمة خصم الايام بعد اول مرة غياب بدون اذن	</td>
               <td> {{ $data['sanctions_value_first_absence']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">قيمة خصم الايام بعد ثاني مرة غياب بدون اذن	  	</td>
               <td> {{ $data['sanctions_value_third_absence']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">قيمة خصم الايام بعد ثالث مرة غياب بدون اذن	 	</td>
               <td> {{ $data['sanctions_value_third_absence']*1 }}</td>
            </tr>
            <tr>
               <td class="width30">قيمة خصم الايام بعد رابع مرة غياب بدون اذن	 	</td>
               <td> {{ $data['sanctions_value_forth_absence']*1 }}</td>
            </tr>
            <tr>
               <td colspan="2" class="text-center">  <a href="{{ route('admin.panel.edit') }}" class="btn btn-sm btn-danger">تعديل</a> </td>
            </tr>
         </table>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection
