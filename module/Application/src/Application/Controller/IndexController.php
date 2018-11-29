<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController;

class IndexController extends ActionController
{
    public $_dbLogger_entity_name = 'Application\Entity\DbLogs';

    public function indexAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData = $request->getPost();
            $fileLogs = false;
            $dbLogs = false;

            try{
                //some activities to be performed on postdata
                // to decide whether filelogs or dblogs has to be called
                if($fileLogs){
                    $this->CustomFileErrorLoggerService()->simpleLog('APIV1_CC_IA_POST_01', "Error occurred with the id : ".$postData['id']);
                }elseif ($dbLogs){
                    $this->CustomDbErrorLoggerService()->logDb(time('now'), 'fatal', "Error occurred with the id : ".$postData['id']);
                }
            } catch (\Exception $ex){
                $this->CustomFileErrorLoggerService()->log('CUSTOM_BLOCK_CODE', $ex);
            }

        }

        return array();
    }
}
