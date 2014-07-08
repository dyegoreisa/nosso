package br.com.biavan.model;

import java.util.Date;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

import br.com.biavan.util.Posicao;

@Entity
@Table(name = "pressao_arterial")
public class PressaoArterial {

	@Id
	@GeneratedValue
	private long id;
	
	@ManyToOne
	@JoinColumn(name = "pessoa_id")
	private Pessoa pessoa;
	
	private Date data;
	
	private Date hora;
	
	private int sistolica;
	
	private int diatolica;
	
	private Posicao posicao;
	
	private boolean emAtividade;

	public long getId() {
		return id;
	}

	public void setId(long id) {
		this.id = id;
	}

	public Pessoa getPessoa() {
		return pessoa;
	}

	public void setPessoa(Pessoa pessoa) {
		this.pessoa = pessoa;
	}

	public Date getData() {
		return data;
	}

	public void setData(Date data) {
		this.data = data;
	}

	public Date getHora() {
		return hora;
	}

	public void setHora(Date hora) {
		this.hora = hora;
	}

	public int getSistolica() {
		return sistolica;
	}

	public void setSistolica(int sistolica) {
		this.sistolica = sistolica;
	}

	public int getDiatolica() {
		return diatolica;
	}

	public void setDiatolica(int diatolica) {
		this.diatolica = diatolica;
	}

	public Posicao getPosicao() {
		return posicao;
	}

	public void setPosicao(Posicao posicao) {
		this.posicao = posicao;
	}

	public boolean isEmAtividade() {
		return emAtividade;
	}

	public void setEmAtividade(boolean emAtividade) {
		this.emAtividade = emAtividade;
	}
	
		
}
