package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.dao.generic.GenericDAO;
import br.com.biavan.model.Perfil;

public interface PerfilDAO extends GenericDAO<Perfil, Long> {

	public Perfil buscarPorCodigo(String codigo);
}
