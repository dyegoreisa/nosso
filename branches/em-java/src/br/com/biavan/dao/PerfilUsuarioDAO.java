package br.com.biavan.dao;

import java.util.List;

import br.com.biavan.model.PerfilUsuario;

public interface PerfilUsuarioDAO {
	public boolean salvar(PerfilUsuario perfilUsuario);
	public boolean atualizar(PerfilUsuario perfilUsuario);
	public boolean remover(PerfilUsuario perfilUsuario);
	public List<PerfilUsuario> listar();
	public List<PerfilUsuario> buscar(List<String> params);
	public PerfilUsuario buscarPorId(long id);
}
