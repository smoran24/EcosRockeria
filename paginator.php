<?php
class Paginator { //es una clase auxiliar y está destinada a la paginación, solo se basará en una conexión válida al servidor MySQL
    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    public function __construct( $conn, $query ) { //metodo constructor para la clase. Solo establece la conexión de la base de datos del objeto y la consulta necesaria, luego de eso calcula el número total de filas recuperadas por esa consulta sin ningún límite ni parámetros de omisión
        $this->_conn = $conn;
        $this->_query = $query;
        $rs= $this->_conn->query( $this->_query );
        $this->_total = $rs->num_rows;
    }

    public function getData($page = 1, $limit = 10 ) { //método que paginará los datos y devolverá los resultados.
        $this->_limit = $limit;
        $this->_page = $page;
        if ( $this->_limit == 'all' ) { //comprobamos si el usuario requiere un número determinado de filas o todas ellas
            $query = $this->_query;
        } else {
            $query = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
        }
        $rs = $this->_conn->query( $query ); //accede a la base de datos con una sentencia sql
        while ( $row = $rs->fetch_assoc() ) { //recorre los registros y los regresa como arrays de valores asociados
            $results[] = $row; //muestra los resultados de la sentencia en forma de filas
        }
        $result = new stdClass();
        $result->page = $this->_page;
        $result->limit = $this->_limit;
        $result->total = $this->_total;
        $result->data = $results;
        return $result;
    }

    public function createLinks( $links, $list_class ) { //metodo para obtener los enlaces de paginación.
        if ( $this->_limit == 'all' ) { //evaluamos si el usuario requiere una cantidad dada de enlaces (links) o todos
            return ''; //devolvemos una cadena vacía ya que no se requiere paginación.
        }
        $last       = ceil( $this->_total / $this->_limit ); //calculamos la última página en función de la cantidad total de filas disponibles y los elementos necesarios por página.
        $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1; //tomamos el parámetro de enlaces (links) que representa el número de enlaces para mostrar debajo y encima de la página actual, y calculamos el enlace de inicio y final.
        $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
        $html       = '<ul class="' . $list_class . '">'; //creamos la etiqueta de apertura para la lista y establecemos su clase con el parámetro de clase de lista y agregamos el enlace de "página anterior"
        $class      = ( $this->_page == 1 ) ? "disabled" : "";
        $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '">&laquo;</a></li>';
        if ( $start > 1 ) { //mostramos un enlace a la primera página y un símbolo de puntos suspensivos en caso de que el enlace de inicio no sea el primero.
            $html   .= '<li><a href="?limit=' . $this->_limit . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>'; 
        }
        for ( $i = $start ; $i <= $end; $i++ ) { //agregamos los enlaces debajo y encima de la página actual basados ​​en los parámetros de inicio y fin calculados previamente
            $class  = ( $this->_page == $i ) ? "active" : "";
            $html   .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
        }
        if ( $end < $last ) { //mostramos otro símbolo de puntos suspensivos y el enlace a la última página en caso de que el enlace final no sea el último.
            $html   .= '<li class="disabled"><span>...</span></li>'; 
            $html   .= '<li><a href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
        }
        $class      = ( $this->_page == $last ) ? "disabled" : ""; //mostramos el enlace "siguiente página" y configuramos el estado deshabilitado cuando el usuario está viendo la última página, cerramos la lista y devolvemos la cadena HTML generada.
        $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '">&raquo;</a></li>';
        $html       .= '</ul>';
        return $html;
    }
}
?>