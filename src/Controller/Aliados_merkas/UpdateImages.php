<?php
declare(strict_types=1);

namespace App\Controller\Aliados_merkas;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface;
 

final class UpdateImages extends Base

{
     /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        
        $input = (array) $request->getParsedBody();

        $uploadedFiles = $request->getUploadedFiles(); 
        
        $file = $uploadedFiles['img']; 
        
        if ($file->getError() === UPLOAD_ERR_OK) {

            $aliado_merkas = $this->getAliados_merkasService()->updatePortada((int) $input['aliado_merkas_id']  , $file);
        }else{

            $aliado_merkas = array("error" => "error cargando imagen");
        }

        return $response->withJson($aliado_merkas);
    }

}

?>