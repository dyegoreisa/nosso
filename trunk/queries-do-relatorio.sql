
SELECT
    oc.id
    , tsoc.nome as status
    , toc.nome as tipo
    , DATE_FORMAT(oc.vencimento, '%d/%m/%Y') as vencimento
    , FORMAT(oc.valor, 2) as valor
    , oc.protocolo
FROM operacao_contabil oc
    JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
    JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
    JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id

ORDER BY status, tipo, vencimento;

SELECT
    sum(oc.valor) as valor
FROM operacao_contabil oc
    JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
    JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
    JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
WHERE tsoc.nome = 'A pagar';

SELECT
    sum(oc.valor) as valor
FROM operacao_contabil oc
    JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
    JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
    JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
WHERE tsoc.nome = 'Pago';

SELECT
    sum(oc.valor) as valor
FROM operacao_contabil oc
    JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
    JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
    JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
WHERE tsoc.nome = 'Estimativa';

SELECT
    sum(oc.valor) as valor
FROM operacao_contabil oc
    JOIN tipo_operacao_contabil toc ON toc.id = oc.tipo_operacao_contabil_id
    JOIN status_operacao_contabil soc ON soc.operacao_contabil_id = oc.id AND soc.data_fim IS NULL
    JOIN tipo_status_operacao_contabil tsoc ON tsoc.id = soc.tipo_status_operacao_contabil_id
WHERE tsoc.nome IN ('A pagar', 'Estimativa');


