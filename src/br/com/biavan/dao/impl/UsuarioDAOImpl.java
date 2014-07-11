package br.com.biavan.dao.impl;

import org.hibernate.Query;

import br.com.biavan.dao.UsuarioDAO;
import br.com.biavan.dao.generic.GenericDAOImpl;
import br.com.biavan.model.Usuario;
import br.com.biavan.util.HibernateUtil;

public class UsuarioDAOImpl extends GenericDAOImpl<Usuario, Long> implements
		UsuarioDAO {

	@Override
	public Usuario buscarPorLogin(String login) {
		String sql = "SELECT u FROM usuario u WHERE p.login = :login";
		Query query = HibernateUtil.getSession().createQuery(sql)
				.setParameter("login", login);
		return buscarUm(query);
	}

}
