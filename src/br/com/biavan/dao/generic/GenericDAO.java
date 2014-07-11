package br.com.biavan.dao.generic;

import java.io.Serializable;
import java.util.List;

import org.hibernate.Query;

public interface GenericDAO<T, ID extends Serializable> {

	public void salvar(T entidade);
	
	public void atualizar(T entidade);
	
	public void remover(T entidade);
	
	public List<T> listar(Class Clazz);
	
	public T buscarPorId(Class clazz, long id);	
	
    public List<T> buscarMuitos(Query query);
 
    public T buscarUm(Query query);
 
 

}
