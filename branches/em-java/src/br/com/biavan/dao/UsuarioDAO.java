package br.com.biavan.dao;

import br.com.biavan.dao.generic.GenericDAO;
import br.com.biavan.model.Usuario;


public interface UsuarioDAO extends GenericDAO<Usuario, Long> {

	public Usuario buscarPorLogin(String login);
}
