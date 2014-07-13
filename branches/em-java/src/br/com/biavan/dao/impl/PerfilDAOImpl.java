package br.com.biavan.dao.impl;

import org.hibernate.Query;

import br.com.biavan.dao.PerfilDAO;
import br.com.biavan.dao.generic.GenericDAOImpl;
import br.com.biavan.model.Perfil;
import br.com.biavan.util.HibernateUtil;

public class PerfilDAOImpl extends GenericDAOImpl<Perfil, Long> implements PerfilDAO {

	@Override
	public Perfil buscarPorCodigo(String codigo) {
		String sql = "SELECT p FROM Perfil p WHERE p.codigo = :codigo";
		Query query = HibernateUtil.getSession().createQuery(sql)
				.setParameter("codigo", codigo);
		return buscarUm(query);
	}

	
}
