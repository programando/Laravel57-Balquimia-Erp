<?php

        if (!function_exists('active_route')) {
            function active_route($route, $output = 'active')   {
                if (Route::current()->getName() == $route)
                    return $output;
            }
        }

        if (!function_exists('User')) {
            function User()    {
                return auth()->user();
            }
        }

        if (!function_exists('TrimString')) {
            /**
             * MARZO 16 2018
             * Retorna un string sin espacios extenos e internos, con la longitus indicada
             */
            function TrimString( $String, $Long ) {
                $String = trim( $String );
                $String = preg_replace('/\s\s+/', ' ', $String  );
                $String = substr($String, 0, $Long  );
                $String = mb_strtoupper( $String,'UTF-8');
                return $String;
            }
        }


        if (!function_exists('FileName')) {
            /** * MARZO 18 2018
             * Retorna un nombre unico de archivo*/
            function FileName( $File, $Hach ) {
                 return 'file_' . $Hach.'.'.$File->getClientOriginalExtension();
            }
        }

        if (!function_exists('FileExtension')) {
            /** * MARZO 18 2018
             * Retorna un nombre unico de archivo*/
            function FileExtension( $File ) {
                 return $File->getClientOriginalExtension();
            }
        }


        if (!function_exists('FileUnqName')) {
            /** MARZO 18 2018
             * Retorna un nombre unico de archivo */
            function FileUnqName( $File ) {
                return  'file_' . time().'.'.$File->getClientOriginalExtension();
            }
        }


        if (!function_exists('FolderImages')) {
            /** * MARZO 18 2018.  Retorna ruta base para el almacenamiento de imagenes */
            function FolderImages(  ) {
                return   asset('storage/images/');
            }
        }

        if (!function_exists('FolderImagesUsers')) {
            /** * MARZO 18 2018.  Retorna ruta base para el almacenamiento de imagenes */
            function FolderImagesUsers(  ) {
                return   asset('storage/images/users/');
            }
        }


        if (!function_exists('SetActiveRoute')) {
            // Establece la ruta activa
            function SetActiveRoute( $NomRuta ) {
                return   request()->routeIs( $NomRuta ) ? 'treeview active' : 'treeview';
            }
        }

      if (!function_exists('FolderImagesApp')) {
            // Establece la ruta activa
            function FolderImagesApp( ) {
                return    asset('storage/images/app/');
            }
        }


?>
