package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.model.Perfil;

public interface PerfilDAO {
	public boolean salvar(Perfil perfil);
	public boolean atualizar(Perfil perfil);
	public boolean remover(Perfil perfil);
	public List<Perfil> listar();
	public List<Perfil> buscar(List<String> params);
	public Perfil buscarPorId(long id);
}
