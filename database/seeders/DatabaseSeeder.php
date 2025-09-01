<?php

namespace Database\Seeders;

use App\Models\{
    User,
    Company,
    AccountGroup,
    Account,
    Site
};
use Illuminate\Support\Str;
use App\Models\InvoicePrintConfig;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'id' => 1,
            'name' => 'SiteTrakr',
            'address' => 'Koppa',
            'city' => 'Koppa',
            'country' => 'India',
            'pincode' => '560001',
            'phone' => '08265221052',
            'email' => 'unnathisoft@gmail.com',
            'website' => 'https://www.unnathisoft.com/?ref=sitetrakr',
            'gstin' => '29HHGFG9999G1JZ',
        ]);


        $superUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin.com'),
            'company_id' => 1,
        ]);

        $f = false;
        $accountgroups = [
            //Primary Accounts
            ['id' => 1, 'name' => 'Current Assets', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 2, 'name' => 'Capital Account', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 3, 'name' => 'Current Liabilities', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 4, 'name' => 'Fixed Assets', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 5, 'name' => 'Loans (Liability)', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 6, 'name' => 'Revenue Accounts', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 7, 'name' => 'Investments', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 8, 'name' => 'Pre-Perative Expenses', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 9, 'name' => 'Profit & Loss', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 10, 'name' => 'Suspense Account', 'primary_id' => null, 'is_editable' => $f, 'is_deletable' => $f],
            //Current Assets
            ['id' => 11, 'name' => 'Bank Accounts', 'primary_id' => 1, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 12, 'name' => 'Cash-in-Hand', 'primary_id' => 1, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 13, 'name' => 'Loans & Advances (Asset)', 'primary_id' => 1, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 14, 'name' => 'Securities & Deposits (Asset)', 'primary_id' => 1, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 15, 'name' => 'Stock-in-hand', 'primary_id' => 1, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 16, 'name' => 'Sundry Debtors', 'primary_id' => 1, 'is_editable' => $f, 'is_deletable' => $f],
            //Capital Accounts
            ['id' => 17, 'name' => 'Reseves & Surplus', 'primary_id' => 2, 'is_editable' => $f, 'is_deletable' => $f],
            //Current Liabilities
            ['id' => 18, 'name' => 'Duties & Taxes', 'primary_id' => 3, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 19, 'name' => 'Provisions/Expenses Payable', 'primary_id' => 3, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 20, 'name' => 'Sundry Creditors', 'primary_id' => 3, 'is_editable' => $f, 'is_deletable' => $f],
            //Loans (Liability)
            ['id' => 21, 'name' => 'Bank O/D Account', 'primary_id' => 5, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 22, 'name' => 'Secured Loans', 'primary_id' => 5, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 23, 'name' => 'Unsecured Loans', 'primary_id' => 5, 'is_editable' => $f, 'is_deletable' => $f],
            //Revenue Accounts
            ['id' => 24, 'name' => 'Expenses (Direct/Mfg)', 'primary_id' => 6, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 25, 'name' => 'Expenses (Indirect/Admin)', 'primary_id' => 6, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 26, 'name' => 'Income (Direct/Opr)', 'primary_id' => 6, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 27, 'name' => 'Income (Indirect)', 'primary_id' => 6, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 28, 'name' => 'Purchase', 'primary_id' => 6, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 29, 'name' => 'Sale', 'primary_id' => 6, 'is_editable' => $f, 'is_deletable' => $f],
            //Revenue Accounts
            ['id' => 30, 'name' => 'Loan Interests', 'primary_id' => 25, 'is_editable' => $f, 'is_deletable' => $f],
            ['id' => 31, 'name' => 'Labors', 'primary_id' => 25, 'is_editable' => $f, 'is_deletable' => $f],
        ];
        foreach ($accountgroups as $accountgroup) {
            AccountGroup::create([
                'id'           => $accountgroup['id'],
                'name'         => $accountgroup['name'],
                'primary_id'   => $accountgroup['primary_id'],
                'is_editable'  => $accountgroup['is_editable'],
                'is_deletable' => $accountgroup['is_deletable'],
            ]);
        }
        $accounts = [
            ['id' => 1, 'group_id' => 12, 'name' => 'Cash'],
            ['id' => 2, 'group_id' => 1, 'name' => 'SGST Adjustable Agnst. Advance'],
            ['id' => 3, 'group_id' => 1, 'name' => 'SGST Input Available (RCM)'],
            ['id' => 4, 'group_id' => 1, 'name' => 'CGST Adjustable Agnst. Advance'],
            ['id' => 5, 'group_id' => 1, 'name' => 'CGST Input Available (RCM)'],
            ['id' => 6, 'group_id' => 1, 'name' => 'IGST Adjustable Agnst. Advance'],
            ['id' => 7, 'group_id' => 1, 'name' => 'IGST Input Available (RCM)'],
            ['id' => 8, 'group_id' => 1, 'name' => 'IGST Refundable Agnst. Export / SEZ Unit'],
            ['id' => 9, 'group_id' => 1, 'name' => 'Cess Adjustable Agnst. Advance'],
            ['id' => 10, 'group_id' => 1, 'name' => 'Add. Cess Adjustable Agnst. Advance'],
            ['id' => 11, 'group_id' => 1, 'name' => 'Cess Input Available (RCM)'],
            ['id' => 12, 'group_id' => 18, 'name' => 'Add. Cess on GST Input'],
            ['id' => 13, 'group_id' => 18, 'name' => 'Add. Cess on GST Output'],
            ['id' => 14, 'group_id' => 18, 'name' => 'Cess on GST Input'],
            ['id' => 15, 'group_id' => 18, 'name' => 'Cess on GST Output'],
            ['id' => 16, 'group_id' => 18, 'name' => 'Cess Output (RCM)'],
            ['id' => 17, 'group_id' => 18, 'name' => 'CGST Input'],
            ['id' => 18, 'group_id' => 18, 'name' => 'CGST Output'],
            ['id' => 19, 'group_id' => 18, 'name' => 'CGST Output (RCM)'],
            ['id' => 20, 'group_id' => 18, 'name' => 'Edu. Cess on TDS'],
            ['id' => 21, 'group_id' => 18, 'name' => 'IGST Input'],
            ['id' => 22, 'group_id' => 18, 'name' => 'IGST Output'],
            ['id' => 23, 'group_id' => 18, 'name' => 'IGST Output (RCM)'],
            ['id' => 24, 'group_id' => 18, 'name' => 'SGST Input'],
            ['id' => 25, 'group_id' => 18, 'name' => 'SGST Output'],
            ['id' => 26, 'group_id' => 18, 'name' => 'SGST Output (RCM)'],
            ['id' => 27, 'group_id' => 18, 'name' => 'SHE Cess on TDS'],
            ['id' => 28, 'group_id' => 18, 'name' => 'TCS (CGST)'],
            ['id' => 29, 'group_id' => 18, 'name' => 'TCS (IGST)'],
            ['id' => 30, 'group_id' => 18, 'name' => 'TCS (SGST)'],
            ['id' => 31, 'group_id' => 18, 'name' => 'TCS (Tax Collected at Source)'],
            ['id' => 32, 'group_id' => 18, 'name' => 'TDS (CGST)'],
            ['id' => 33, 'group_id' => 18, 'name' => 'TDS (Commission or Brokerage)'],
            ['id' => 34, 'group_id' => 18, 'name' => 'TDS (Contracts to Individuals/HUF)'],
            ['id' => 35, 'group_id' => 18, 'name' => 'TDS (Contracts to Others)'],
            ['id' => 36, 'group_id' => 18, 'name' => 'TDS (Contracts to Transporter)'],
            ['id' => 37, 'group_id' => 18, 'name' => 'TDS (IGST)'],
            ['id' => 38, 'group_id' => 18, 'name' => 'TDS (Interest from a Banking Co)'],
            ['id' => 39, 'group_id' => 18, 'name' => 'TDS (Interest from a NonBanking Co)'],
            ['id' => 40, 'group_id' => 18, 'name' => 'TDS (Professionals Services)'],
            ['id' => 41, 'group_id' => 18, 'name' => 'TDS (Rent of Land)'],
            ['id' => 42, 'group_id' => 18, 'name' => 'TDS (Rent of Plant & Machinery)'],
            ['id' => 43, 'group_id' => 18, 'name' => 'TDS (Salary)'],
            ['id' => 44, 'group_id' => 18, 'name' => 'TDS (SGST)'],
            ['id' => 45, 'group_id' => 18, 'name' => 'TDS on Pymt./Purc. of Goods'],
            ['id' => 46, 'group_id' => 25, 'name' => 'Advertisement & Publicity'],
            ['id' => 47, 'group_id' => 25, 'name' => 'Bad Debts Written Off'],
            ['id' => 48, 'group_id' => 25, 'name' => 'Bank Charges'],
            ['id' => 49, 'group_id' => 25, 'name' => 'Books & Periodicals'],
            ['id' => 50, 'group_id' => 25, 'name' => 'Charity & Donations'],
            ['id' => 51, 'group_id' => 25, 'name' => 'Commission on Sales'],
            ['id' => 52, 'group_id' => 25, 'name' => 'Conveyance Expenses'],
            ['id' => 53, 'group_id' => 25, 'name' => 'Customer Entertainment Expenses'],
            ['id' => 54, 'group_id' => 25, 'name' => 'Depreciation A/c'],
            ['id' => 55, 'group_id' => 25, 'name' => 'Freight & Forwarding Charges'],
            ['id' => 56, 'group_id' => 25, 'name' => 'Legal Expenses'],
            ['id' => 57, 'group_id' => 25, 'name' => 'Miscellaneous Expenses'],
            ['id' => 58, 'group_id' => 25, 'name' => 'Office Maintenance Expenses'],
            ['id' => 59, 'group_id' => 25, 'name' => 'Office Rent'],
            ['id' => 60, 'group_id' => 25, 'name' => 'Postal Expenses'],
            ['id' => 61, 'group_id' => 25, 'name' => 'Printing & Stationery'],
            ['id' => 62, 'group_id' => 25, 'name' => 'Rounded Off'],
            ['id' => 63, 'group_id' => 25, 'name' => 'Salary'],
            ['id' => 64, 'group_id' => 25, 'name' => 'Sales Promotion Expenses'],
            ['id' => 65, 'group_id' => 25, 'name' => 'Service Charges Paid'],
            ['id' => 66, 'group_id' => 25, 'name' => 'Staff Welfare Expenses'],
            ['id' => 67, 'group_id' => 25, 'name' => 'Telephone Expenses'],
            ['id' => 68, 'group_id' => 25, 'name' => 'Travelling Expenses'],
            ['id' => 69, 'group_id' => 25, 'name' => 'Water & Electricity Expenses'],
            ['id' => 70, 'group_id' => 4, 'name' => 'Capital Equipments'],
            ['id' => 71, 'group_id' => 4, 'name' => 'Computers'],
            ['id' => 72, 'group_id' => 4, 'name' => 'Furniture & Fixture'],
            ['id' => 73, 'group_id' => 4, 'name' => 'Office Equipments'],
            ['id' => 74, 'group_id' => 4, 'name' => 'Plant & Machinery'],
            ['id' => 75, 'group_id' => 27, 'name' => 'Service Charges Receipts'],
            ['id' => 76, 'group_id' => 9, 'name' => 'Profit & Loss'],
            ['id' => 77, 'group_id' => 19, 'name' => 'Salary & Bonus Payable'],
            ['id' => 78, 'group_id' => 28, 'name' => 'Purchase'],
            ['id' => 79, 'group_id' => 29, 'name' => 'Sales'],
            ['id' => 80, 'group_id' => 14, 'name' => 'Earnest Money'],
            ['id' => 81, 'group_id' => 15, 'name' => 'Stock'],
        ];
        foreach ($accounts as $account) {
            Account::create([
                'id' => $account['id'],
                'group_id' => $account['group_id'],
                'name' => $account['name'],
                'is_editable' => 0,
                'is_deletable' => 0,
            ]);
        }

        //Demo DATA
        Account::create([
            'id' => 85,
            'group_id' => 16,
            'name' => 'Demo Site Owner',
            'is_registered' => false,
            'op_balance' => 0,
            'cr_dr' => 'Dr',
            'is_editable' => 1,
            'is_deletable' => 1,
        ]);

        Site::create([
            'id' => 1,
            'account_id' => 85,
            'name' => 'Demo Site',
            'address' => 'Demo address',
            'longitude' => 0,
            'latitude' => 0,
            'status' => 'in_progress'
        ]);
        //Demo DATA

        //Roles
        $roles = [
            ['name' => 'super_admin'],
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'employee'],
            ['name' => 'public'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }

        $superUser->assignRole('super_admin');
    }
}
