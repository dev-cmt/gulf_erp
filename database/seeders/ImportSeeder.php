<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\InfoPersonal;
use App\Models\Master\MastDepartment;
use App\Models\Master\MastDesignation;
use App\Models\Master\MastEmployeeType;
use App\Models\Master\MastWorkStation;
use App\Models\Master\MastLeave;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //______________MASTER________________//
        MastDepartment::create([
            'dept_name'=>'AC',
            'dept_head'=>'1',
            'description'=>'A department is one section or part of a larger group.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'AC Spare Parts',
            'dept_head'=>'1',
            'description'=>'A department is one section or part of a larger group.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDepartment::create([
            'dept_name'=>'Car Spare Parts',
            'dept_head'=>'1',
            'description'=>'A department is one section or part of a larger group.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastDesignation::create([
            'desig_name'=>'CEO (Chief Executive Officer)',
            'description'=>'The highest-ranking officer in a company who is responsible for making major corporate decisions, managing the overall operations and resources of the company, and acting as the main point of communication between the board of directors and the companys management team.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'GM (General Manager)',
            'description'=>'The person in charge of managing a specific business unit or division within the company.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Director',
            'description'=>'An executive-level position that oversees a particular department or function within the company.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'HR Manager',
            'description'=>'Developing and implementing HR policies and procedures that align with the company goals and objectives',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Sales Manager',
            'description'=>'A Sales Manager is an executive-level position responsible for managing the sales department of a company. They oversee the company sales policies and procedures, including sales strategies, customer relationships, sales forecasting, and revenue generation.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Store Manager',
            'description'=>'A Store Manager is a mid-level position responsible for managing the day-to-day operations of a retail store. They oversee the store policies and procedures, including customer service, inventory management, sales, and staff management.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Marketing Manager',
            'description'=>'A Marketing Manager is an executive-level position responsible for managing a company marketing strategies and initiatives. They oversee the marketing department, including advertising, promotions, market research, and brand management.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Supervisor',
            'description'=>'A lower-level position that is responsible for overseeing a small team or group of employees.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Service Technician',
            'description'=>'A Service Technician, also known as a Field Service Technician, is a skilled worker who provides technical support and maintenance services to customers. They typically work in industries such as information technology, telecommunications, healthcare, and manufacturing.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Installation Technician',
            'description'=>'
            An Installation Technician is a skilled worker who is responsible for installing and setting up various types of equipment and systems. They work in a variety of industries, including telecommunications, information technology, healthcare, and manufacturing.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Customer Service',
            'description'=>'Customer service is the support and assistance provided to customers before, during, and after they purchase a product or service. It involves a range of activities designed to enhance the customer experience, increase customer satisfaction, and promote customer loyalty.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastDesignation::create([
            'desig_name'=>'Staff',
            'description'=>'An entry-level position that typically involves performing administrative or support duties.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastEmployeeType::create([
            'cat_name'=>'Full-Time Employees',
            'cat_type'=>'1',
            'description'=>'These are employees who work for the company on a regular basis and are typically paid a salary or an hourly wage. They may be eligible for benefits such as health insurance, retirement plans, and paid time off.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Part-Time Employees',
            'cat_type'=>'1',
            'description'=>'These are employees who work for the company on a part-time basis, usually less than 40 hours per week. They may be paid an hourly wage and may or may not be eligible for benefits depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Contract Employees',
            'cat_type'=>'1',
            'description'=>'These are individuals who work for the company on a temporary basis and are usually hired to perform a specific job or task. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Interns',
            'cat_type'=>'1',
            'description'=>'These are students or recent graduates who work for the company on a temporary basis to gain work experience and develop skills. They may be paid a stipend or may work for free, and are typically not eligible for benefits.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Consultants',
            'cat_type'=>'1',
            'description'=>'These are individuals or firms who are hired by the company to provide specialized expertise or services on a project basis. They may be paid a flat fee or an hourly rate and are typically not eligible for benefits.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastEmployeeType::create([
            'cat_name'=>'Seasonal Employees',
            'cat_type'=>'1',
            'description'=>'These are employees who work for the company during specific times of the year when there is a higher demand for the companys products or services. They may be paid an hourly wage and may or may not be eligible for benefits depending on the companys policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);

        //____________________________________//
        MastLeave::create([
            'leave_name'=>'Vacation Leave',
            'max_limit'=>'1',
            'leave_code'=>'LV-0001',
            'yearly_limit'=>'3',
            'description'=>'This is time off that an employee can take for rest, relaxation, or personal reasons. Vacation leave is usually earned based on the length of time the employee has worked for the company.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Sick Leave',
            'max_limit'=>'1',
            'leave_code'=>'LV-0002',
            'yearly_limit'=>'3',
            'description'=>'This is time off that an employee can take when they are ill or injured. Sick leave may be paid or unpaid, depending on the companys policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Personal Leave',
            'max_limit'=>'1',
            'leave_code'=>'LV-0003',
            'yearly_limit'=>'3',
            'description'=>'This is time off that an employee can take for personal reasons, such as attending to family matters or dealing with a personal emergency.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Parental Leave',
            'max_limit'=>'1',
            'leave_code'=>'LV-0004',
            'yearly_limit'=>'3',
            'description'=>'This is time off that an employee can take when they become a parent, either through childbirth or adoption. Parental leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Bereavement Leave',
            'max_limit'=>'1',
            'leave_code'=>'LV-0005',
            'yearly_limit'=>'3',
            'description'=>'This is time off that an employee can take when a close family member dies. Bereavement leave is usually paid and the amount of time off may vary depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Maternity Leave',
            'max_limit'=>'1',
            'leave_code'=>'LV-0006',
            'yearly_limit'=>'3',
            'description'=>'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastLeave::create([
            'leave_name'=>'Maternity Leave',
            'max_limit'=>'1',
            'leave_code'=>'LV-0006',
            'yearly_limit'=>'3',
            'description'=>'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//
        MastWorkStation::create([
            'store_name'=>'Gulf international associates ltd.',
            'contact_number'=>'01995275933',
            'location'=>'Gulshan',
            'description'=>'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        MastWorkStation::create([
            'store_name'=>'Icon information Systems ltd.',
            'contact_number'=>'01995275933',
            'location'=>'Mirpur',
            'description'=>'This is time off that a female employee can take before and after childbirth. Maternity leave may be paid or unpaid, depending on the company policies.',
            'status'=>'1',
            'user_id'=>'1'
        ]);
        //____________________________________//

        //__________EMPLOYEE INFO_____________//
        InfoPersonal::create([
            'date_of_birth'=>'2002-01-01',
            'employee_gender'=>'0',
            'nid_no'=>'25745545458',
            'blood_group'=>'3',
            'mast_department_id'=>'1',
            'mast_designation_id'=>'5',
            'mast_employee_type_id'=>'2',
            'mast_work_station_id'=>'2',
            'number_official'=>'0195275932',
            'email_official'=>'motiur@gulf.com',
            'joining_date'=>'2022-11-01',
            'service_length'=>'2',
            'gross_salary'=>'15000',
            'reporting_boss'=>'1',
            
            'division_present'=>'6',
            'district_present'=>'42',
            'upazila_present'=>'322',
            'thana_present'=>'2887',
            'address_present'=>'Khilgoan, Domshar, Shariatpur',
    
            'division_permanent'=>'6',
            'district_permanent'=>'42',
            'upazila_permanent'=>'322',
            'thana_permanent'=>'2887',
            'address_permanent'=>'Khilgoan, Domshar, Shariatpur',
    
            'passport_no'=>'1185344689',
            'driving_license'=>'0415441482',
            'marital_status'=>'0',
            'house_phone'=>'01922437143',
            'father_name'=>'Mosharraf Khan',
            'mother_name'=>'Shilpy Begum',
            'birth_certificate_no'=>'20222145678938',
            'emg_person_name'=>'Sagour',
            'emg_phone_number'=>'01995275933',
            'emg_relationship'=>'Brother',
            'emg_address'=>'Shariatpur',
            'status'=>'1',
            'user_id'=>'1',
            'emp_id'=> '1'
        ]);

    }
}
