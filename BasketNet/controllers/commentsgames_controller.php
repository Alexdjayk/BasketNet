<?php
class CommentsgamesController extends AppController{

/**
 * Cette fonction permet de récupérer le nombre de commentaires, validés, pour un match donné
 *
 * @param 	integer $postId 	Identifiant du match
 * @access 	public
 */
	function get_nb_comments($gamesId) {
		//En ligne et correspondant au match ciblé
		$conditions = array('online' => 1, 'games_id' => $gamesId);
		//On retourne le nbr de commentaires pour ce match en fonction des conditions
		return $this->Commentsgame->findCount($conditions);
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
		$d['nbCommentsgames'] = $this->Commentsgame->findCount();
		$d['commentsgames'] = $this->Commentsgame->find(array(
			'limit'=> $limit.', '.$d['elementPerPage'],
		));
		$d['nbPages'] = ceil($d['nbCommentsgames'] / $d['elementPerPage']); 
		$this->set($d);
		// Affichage le nombres de commentaires validés(ou online)
		$conditions = array('online'=> 1);
		$nbCommentairesgames = $this->Commentsgame->findCount($conditions);
		$this->set('nbCommentairesgames', $nbCommentairesgames);
	}
}