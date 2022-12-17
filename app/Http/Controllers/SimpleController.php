<?php

namespace App\Http\Controllers;

require( "../lib/DataTables.php" );

use DataTables\Editor;
use DataTables\Editor\Field;
use DataTables\Editor\Format;
use DataTables\Editor\Validate;
use DataTables\Editor\ValidateOptions;


class SimpleController extends Controller
{
    public function index(){
        return view('examples.simple');
    }

    public function getAll(){
        global $db;
        return Editor::inst( $db, 'datatables_demo')
            ->fields(
                Field::inst( 'first_name' )
                    ->validator( Validate::notEmpty( ValidateOptions::inst()
                        ->message( 'A first name is required' )
                    ) ),
                Field::inst( 'last_name' )
                    ->validator( Validate::notEmpty( ValidateOptions::inst()
                        ->message( 'A last name is required' )
                    ) ),
                Field::inst( 'position' ),
                Field::inst( 'email' )
                    ->validator( Validate::email( ValidateOptions::inst()
                        ->message( 'Please enter an e-mail address' )
                    ) ),
                Field::inst( 'office' ),
                Field::inst( 'extn' ),
                Field::inst( 'age' )
                    ->validator( Validate::numeric() )
                    ->setFormatter( Format::ifEmpty(null) ),
                Field::inst( 'salary' )
                    ->validator( Validate::numeric() )
                    ->setFormatter( Format::ifEmpty(null) ),
                Field::inst( 'start_date' )
                    ->validator( Validate::dateFormat( 'Y-m-d' ) )
                    ->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
                    ->setFormatter( Format::dateFormatToSql('Y-m-d' ) )
            )
            ->process($_POST)
            ->json();
    }
}
