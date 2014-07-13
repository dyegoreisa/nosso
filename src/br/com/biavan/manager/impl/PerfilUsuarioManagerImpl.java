package br.com.biavan.manager.impl;

import org.hibernate.HibernateException;

import br.com.biavan.dao.PerfilUsuarioDAO;
import br.com.biavan.dao.impl.PerfilUsuarioDAOImpl;
import br.com.biavan.manager.PerfilUsuarioManager;
import br.com.biavan.model.PerfilUsuario;
import br.com.biavan.util.HibernateUtil;

public class PerfilUsuarioManagerImpl implements PerfilUsuarioManager {

	PerfilUsuarioDAO perfilUsuarioDAO = new PerfilUsuarioDAOImpl();
	
	@Override
	public void salvarNovoPerfilUsuario(PerfilUsuario perfilUsuario) {
		try {
			HibernateUtil.beginTransaction();
			perfilUsuarioDAO.salvar(perfilUsuario);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
			HibernateUtil.rollbackTransaction();
		}
	}

}
