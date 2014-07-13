package br.com.biavan.manager.impl;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.NonUniqueResultException;

import org.hibernate.HibernateException;

import br.com.biavan.dao.PerfilDAO;
import br.com.biavan.dao.impl.PerfilDAOImpl;
import br.com.biavan.manager.PerfilManager;
import br.com.biavan.model.Perfil;
import br.com.biavan.util.HibernateUtil;

public class PerfilManagerImpl implements PerfilManager {

	PerfilDAO perfilDAO = new PerfilDAOImpl();
	
	@Override
	public Perfil buscarPerfilPorCodigo(String codigo) {
		Perfil perfil = null;
		try {
			HibernateUtil.beginTransaction();
			perfil = perfilDAO.buscarPorCodigo(codigo);
			HibernateUtil.commitTransaction();
		} catch (NonUniqueResultException ex) {
			System.out.println("Handle your error here");
			System.out.println("Query returned more than one results.");
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return perfil;
	}

	@Override
	public List<Perfil> carregarTodosPerfils() {
		List<Perfil> perfis = new ArrayList<Perfil>();
		try {
			HibernateUtil.beginTransaction();
			perfis = perfilDAO.listar(Perfil.class);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return perfis;
	}

	@Override
	public void salvarNovoPerfil(Perfil perfil) {
		try {
			HibernateUtil.beginTransaction();
			perfilDAO.salvar(perfil);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
			HibernateUtil.rollbackTransaction();
		}

	}

	@Override
	public Perfil buscarPerfilPorId(long id) {
		Perfil perfil = null;
		try {
			HibernateUtil.beginTransaction();
			perfil = (Perfil) perfilDAO.buscarPorId(Perfil.class, id);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return perfil;
	}

	@Override
	public void removerPerfil(Perfil perfil) {
		try {
            HibernateUtil.beginTransaction();
            perfilDAO.remover(perfil);
            HibernateUtil.commitTransaction();
        } catch (HibernateException ex) {
            System.out.println("Handle your error here");
            HibernateUtil.rollbackTransaction();
        }

	}

}
