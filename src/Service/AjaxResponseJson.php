<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AjaxResponseJson
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    private function formatActionUser($idUser, $active)
    {
        try {
            $action = '<div class="btn-group" role="group" aria-label="Action button">';
            // edit button
            $action .= '<a class="btn btn-sm  btn-primary" href="' . $this->router->generate('admin.user.edit', ['id' => $idUser]) . '" title="Modifier"> 
                                    <span class="icon text-white">
                                        <i class="fas fa-edit"></i> 
                                    </span>
                                </a>&nbsp;';
            if ($active) {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="1" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-check"></i>
                                </span>
                            </a>&nbsp;';
            } else {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="0" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-times"></i>
                                </span>
                            </a>&nbsp;</div>';
            }
            return $action;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function listUserEditor($users): array
    {
        try{
            
            $tmp = [];
            foreach($users as $user){
                $tmp[] = [
                    'id' => $user->getIdUser(),
                    'name' => $user->getFirstName() . ' ' . $user->getLastName(),
                    'role' =>  '<span class="badge rounded-pill bg-'.$user->getIdRole()->getColor().'">'.$user->getIdRole()->getExternCaption().'</span>',
                    'dateLog' => is_null($user->getDateLog()) ? '' : $user->getDateLog()->format('d/m/Y H:i:s'),
                    'action' => $this->formatActionUser($user->getIdUser(), $user->getActive()),
                ];
            }
            return $tmp;
        } catch(\Exception $e){
            return [];
        }
    }

    private function formatActionCourse($idCourse, $active, $qtyChapter)
    {
        try {
            $action = '<div class="btn-group" role="group" aria-label="Action button">';
            // edit button
            $action .= '<a class="btn btn-sm  btn-primary" href="'. $this->router->generate('editor.course.edit', ['id' => $idCourse]) .'" title="Modifier"> 
                                    <span class="icon text-white">
                                        <i class="fas fa-edit"></i> 
                                    </span>
                                </a>&nbsp;';
            // duplicat button
            $action .= '<a class="btn btn-sm  btn-primary" href="'.$this->router->generate('editor.course.duplicate', ['id' => $idCourse]).'" title="Dupliquer"> 
                                <span class="icon text-white">
                                    <i class="fas fa-clone"></i>
                                </span>
                            </a>&nbsp;';
            // see button
            if ($qtyChapter <= 0) {
                $action .= '<a class="btn btn-sm btn-primary disabled" target="_blank" href="'.$this->router->generate('user.course.content').'" title="Voir"> 
                            <span class="icon text-white">
                                <i class="fas fa-eye"></i>
                            </span>
                        </a>&nbsp;';
            } else {
                $action .= '<a class="btn btn-sm btn-primary" target="_blank" href="'.$this->router->generate('user.course.content').'" title="Voir"> 
                            <span class="icon text-white">
                                <i class="fas fa-eye"></i>
                            </span>
                        </a>&nbsp;';
            }
            // add chapter button
            $action .= '<a class="btn btn-sm  btn-primary" title="Ajouter un chapitre" href="'.$this->router->generate('editor.chapter.add', ['id' => $idCourse]).'"> 
                            <span class="icon text-white">
                                <i class="fas fa-plus"></i>
                            </span>
                        </a>&nbsp;';
            // list chapter button
            $action .= '<a class="btn btn-sm  btn-primary" title="Liste des chapitres" href="' . $this->router->generate('editor.chapter.list', ['idCourse' => $idCourse]) . '"> 
                            <span class="icon text-white">
                                <i class="fas fa-list"></i>
                            </span>
                        </a>&nbsp;';
            if ($active) {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="1" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-check"></i>
                                </span>
                            </a>&nbsp;';
            } else {
                $action .= '<a class="btn btn-sm  btn-primary activeButton" value="0" title="Actif"> 
                                <span class="icon text-white">
                                    <i class="fas fa-times"></i>
                                </span>
                            </a>&nbsp;</div>';
            }
            return $action;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @var Course[] $courses
     * @return string
     * Return json data for the datatable
     */
    public function listCourseEditor($courses): array
    {
        try {
            $tmp = [];
            foreach ($courses as $course) {
                $tmp[] = [
                    'id' => $course['course']->getIdCourse(),
                    'caption' => $course['course']->getCaption(),
                    'category' => is_null($course['course']->getIdCategory()) ? '' : $course['course']->getIdCategory()->getCaption(),
                    'qtyChapter' => $course['qtyChapter'],
                    'action' => $this->formatActionCourse($course['course']->getIdCourse(), $course['course']->getActive(), $course['qtyChapter'])
                ];
            }
            return $tmp;
        } catch(\Exception $e) {
            [];
        }
    }

    function formatActionChapter($active, $idChapter)
{
    try {
        $action = '<div class="btn-group" role="group" aria-label="Action button">';
        // edit button
        $action .= '<a class="btn btn-sm  btn-primary" href="'.$this->router->generate('editor.chapter.edit', ['id' => $idChapter]).'" title="Modifier"> 
                                <span class="icon text-white">
                                    <i class="fas fa-edit"></i> 
                                </span>
                            </a>&nbsp;';
        // duplicat button
        $action .= '<a class="btn btn-sm  btn-primary" href="'.$this->router->generate('editor.chapter.duplicate', ['id' => $idChapter]).'&duplicat" title="Dupliquer"> 
                            <span class="icon text-white">
                                <i class="fas fa-clone"></i>
                            </span>
                        </a>&nbsp;';
        if ($active) {
            $action .= '<a class="btn btn-sm  btn-primary activeButton" value="1" title="Actif"> 
                            <span class="icon text-white">
                                <i class="fas fa-check"></i>
                            </span>
                        </a>&nbsp;</div>';
        } else {
            $action .= '<a class="btn btn-sm  btn-primary activeButton" value="0" title="Actif"> 
                            <span class="icon text-white">
                                <i class="fas fa-times"></i>
                            </span>
                        </a>&nbsp;</div>';
        }
        return $action;
    } catch (\Exception $e) {
        return null;
    }
}
    
    /**
     * @var Chapter[] $chapters
     * @return string
     * Return json data for the datatable
     */
    public function listChapterEditor($chapters, $idCourse): array
    {
        try {
            $tmp = [];
            foreach ($chapters as $chapter) {
                $tmp[] = [
                    'id' => $chapter->getIdChapter(),
                    'caption' => $chapter->getCaption(),
                    'step' => $chapter->getStep(),
                    'action' => $this->formatActionChapter($chapter->getActive(), $chapter->getIdChapter())
                ];
            }
            return $tmp;
        } catch(\Exception $e) {
            [];
        }
    }
}
