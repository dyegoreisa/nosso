package br.com.biavan.manager;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.NonUniqueResultException;

import org.hibernate.HibernateException;

import br.com.biavan.dao.UsuarioDAO;
import br.com.biavan.dao.impl.UsuarioDAOImpl;
import br.com.biavan.model.Usuario;
import br.com.biavan.util.HibernateUtil;

public class UsuarioManagerImpl implements UsuarioManager {

	private UsuarioDAO usuarioDAO = new UsuarioDAOImpl();

	@Override
	public Usuario buscarUsuarioPorLogin(String login) {
		Usuario usuario = null;
		try {
			HibernateUtil.beginTransaction();
			usuario = usuarioDAO.buscarPorLogin(login);
			HibernateUtil.commitTransaction();
		} catch (NonUniqueResultException ex) {
			System.out.println("Handle your error here");
			System.out.println("Query returned more than one results.");
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return usuario;
	}

	@Override
	public List<Usuario> carregarTodosUsuarios() {
		List<Usuario> allPersons = new ArrayList<Usuario>();
		try {
			HibernateUtil.beginTransaction();
			allPersons = usuarioDAO.listar(Usuario.class);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return allPersons;
	}

	@Override
	public void salvarNovoUsuario(Usuario usuario) {
		try {
			HibernateUtil.beginTransaction();
			usuarioDAO.salvar(usuario);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
			HibernateUtil.rollbackTransaction();
		}

	}

	@Override
	public Usuario buscarUsuarioPorId(long id) {
		Usuario usuario = null;
		try {
			HibernateUtil.beginTransaction();
			usuario = (Usuario) usuarioDAO.buscarPorId(Usuario.class, id);
			HibernateUtil.commitTransaction();
		} catch (HibernateException ex) {
			System.out.println("Handle your error here");
		}
		return usuario;
	}

	@Override
	public void removerUsuario(Usuario usuario) {
		try {
            HibernateUtil.beginTransaction();
            usuarioDAO.remover(usuario);
            HibernateUtil.commitTransaction();
        } catch (HibernateException ex) {
            System.out.println("Handle your error here");
            HibernateUtil.rollbackTransaction();
        }

	}

}
