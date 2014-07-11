package br.com.biavan.dao.generic;

import java.io.Serializable;
import java.util.List;

import org.hibernate.Query;
import org.hibernate.Session;

import br.com.biavan.util.HibernateUtil;

public abstract class GenericDAOImpl<T, ID extends Serializable> implements GenericDAO<T, ID> {
 
    protected Session getSession() {
        return HibernateUtil.getSession();
    }
 
    public void salvar(T entity) {
        Session hibernateSession = this.getSession();
        hibernateSession.saveOrUpdate(entity);
    }
 
    public void atualizar(T entity) {
        Session hibernateSession = this.getSession();
        hibernateSession.merge(entity);
    }
 
    public void remover(T entity) {
        Session hibernateSession = this.getSession();
        hibernateSession.delete(entity);
    }

    public List<T> listar(Class clazz) {
        Session hibernateSession = this.getSession();
        List<T> t = null;
        Query query = hibernateSession.createQuery("from " + clazz.getName());
        t = query.list();
        return t;
    }
    
    public T buscarPorId(Class clazz, long id) {
        Session hibernateSession = this.getSession();
        T t = null;
        t = (T) hibernateSession.get(clazz, id);
        return t;
    }
 
    public List<T> buscarMuitos(Query query) {
        List<T> t;
        t = (List<T>) query.list();
        return t;
    }
 
    public T buscarUm(Query query) {
        T t;
        t = (T) query.uniqueResult();
        return t;
    }
    
}
