<?php
class CommentspostsController extends AppController{


/**
 * Cette fonction permet de récupérer le nombre de commentaires, validés, pour un post donné
 *
 * @param 	integer $postId 	Identifiant du post
 * @access 	public
 * @author 	koéZionCMS
 * @version 0.1 - 06/03/2012 by FI
 */
	function get_nb_comments($postId) {
		//En ligne et correspondant au post ciblé
		$conditions = array('online' => 1, 'posts_id' => $postId);
		//On retourne le nbr de commentaires pour l'article en fonction des conditions
		return $this->Commentspost->findCount($conditions);
	}	

	
/** 
* La Fonction backoffice_index permet d'afficher tous les éléments du backoffice_index du controller sur lequel l'admin se trouve.
* et ainsi avoir la possibilité de modifier, ajouter, supprimer.
*
* @access 	public
**/
	function backoffice_index(){
		// fonction pagination
		$d['elementPerPage'] = 25; // NB d'elements par pages 
		$d['page'] = $this->request->page; // Nb de pages (voir fonction request)
		$limit = $d['elementPerPage'] * ($d['page']-1); // limit par pages
		$d['nbCommentsposts'] = $this->Commentspost->findCount();
		$d['commentsposts'] = $this->Commentspost->find(array(
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbCommentsposts'] / $d['elementPerPage']); 
		$this->set($d);
		$conditions = array('online'=> 1);
		$nbCommentairesposts = $this->Commentspost->findCount($conditions);
		$this->set('nbCommentairesposts', $nbCommentairesposts);
	}
}