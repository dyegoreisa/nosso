package br.com.biavan.util;

public enum Posicao {

	EM_PE("Em p�"), SENTADO("Sentado"), DEITADO("Deitado");
	
	private String posicao;
	
	Posicao(String posicao) {
		this.posicao = posicao;
	}
	
	public String getPosicao() {
		return posicao;
	}

}
